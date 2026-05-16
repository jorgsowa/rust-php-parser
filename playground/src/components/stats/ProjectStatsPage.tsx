import { useState, useMemo, useCallback, useEffect } from 'react'
import { astNodes } from '../../data/ast-nodes'
import { routeToHash } from '../../router'
import rawStats from '../../data/project-stats.json'

interface ProjectSummary {
  name: string
  slug: string
}

const ALL_PROJECTS: ProjectSummary[] = rawStats as unknown as ProjectSummary[]

interface DirStats {
  files: number
  total_nodes: number
  nodes: Record<string, number>
}

interface ProjectData {
  name: string
  slug: string
  repo: string
  version: string
  scanned_dirs: string[]
  files: number
  total_nodes: number
  nodes: Record<string, number>
  all_dirs: string[]
  dir_stats: Record<string, DirStats>
}

const DOC_LINKS: Record<string, string> = Object.fromEntries(
  astNodes.map(n => [n.name, `#docs/${n.id}`])
)

const NODE_DESCRIPTIONS: Record<string, string> = {
  Expression: 'Expression statement — wraps any expression used as a statement',
  Identifier: 'Bare name used in calls, class refs, constants',
  Variable: 'Variable reference ($name)',
  String: 'Plain string literal',
  MethodCall: 'Object method call ($obj->method(...))',
  Assign: 'Assignment expression ($x = ...)',
  Array: 'Array literal ([1, 2, 3])',
  Int: 'Integer literal',
  Return: 'Return statement',
  FunctionCall: 'Function call (name(...))',
  StaticMethodCall: 'Static method call (Class::method(...))',
  PropertyAccess: 'Property access ($obj->prop)',
  Binary: 'Binary operation ($a + $b, $x === $y, ...)',
  New: 'Object instantiation (new Class(...))',
  If: 'If statement',
  Block: 'Block of statements { ... }',
  ArrayAccess: 'Array element access ($arr[key])',
  Foreach: 'Foreach loop',
  Class: 'Class declaration',
  Function: 'Function declaration',
  NullCoalesce: 'Null coalescing operator (??)',
  Ternary: 'Ternary expression (cond ? a : b)',
  ArrowFunction: 'Arrow function (fn($x) => expr)',
  Closure: 'Closure (function($x) use($y) { })',
  Match: 'Match expression',
  InterpolatedString: 'Double-quoted string with variables',
  ClassConstAccess: 'Class constant access (Class::CONST)',
  Use: 'Use declaration (use Foo\\Bar)',
  Namespace: 'Namespace declaration',
  Interface: 'Interface declaration',
  Trait: 'Trait declaration',
  TryCatch: 'Try/catch/finally block',
  Throw: 'Throw statement',
  While: 'While loop',
  For: 'For loop',
  UnaryPrefix: 'Unary prefix op (!x, -x, ++$x)',
  UnaryPostfix: 'Unary postfix op ($x++, $x--)',
  Cast: 'Type cast ((int)$x, (string)$x)',
  Echo: 'Echo statement',
  Null: 'Null literal',
  Bool: 'Boolean literal (true/false)',
  Isset: 'isset() check',
  StaticPropertyAccess: 'Static property access (Class::$prop)',
  AnonymousClass: 'Anonymous class (new class { })',
  Enum: 'Enum declaration',
  Heredoc: 'Heredoc string (<<<EOT ... EOT)',
}

type SortKey = 'name' | 'count'

const CHILD_RE = /^(.+) \([^)]+\)$/
const isChildKey = (key: string) => CHILD_RE.test(key)
const parentKey = (key: string) => key.replace(/ \([^)]+\)$/, '')

function formatNum(n: number): string {
  return n.toLocaleString()
}

function pct(n: number, total: number): string {
  if (total === 0) return '0%'
  return ((n / total) * 100).toFixed(2) + '%'
}

// ── Directory tree ────────────────────────────────────────────────────────────

interface TreeNode {
  name: string
  path: string
  children: TreeNode[]
  files: number       // PHP files in this dir and all PHP-containing descendants
  total_nodes: number
  hasPhp: boolean     // true if this dir or any descendant contains PHP files
}

function buildTree(dirStats: Record<string, DirStats>, allDirs: string[]): TreeNode {
  const root: TreeNode = { name: '(all)', path: '', children: [], files: 0, total_nodes: 0, hasPhp: false }

  function getOrCreate(parts: string[], upTo: number): TreeNode {
    let node = root
    for (let i = 0; i < upTo; i++) {
      const seg = parts[i]
      let child = node.children.find(c => c.name === seg)
      if (!child) {
        child = { name: seg, path: parts.slice(0, i + 1).join('/'), children: [], files: 0, total_nodes: 0, hasPhp: false }
        node.children.push(child)
      }
      node = child
    }
    return node
  }

  // Insert every known directory into the tree (union of all_dirs + dir_stats keys)
  const allPaths = new Set([...allDirs, ...Object.keys(dirStats)])
  for (const path of allPaths) {
    const parts = path.split('/')
    for (let i = 1; i <= parts.length; i++) getOrCreate(parts, i)
  }

  // Stamp direct PHP file counts onto the nodes that have them
  for (const [path, ds] of Object.entries(dirStats)) {
    const node = getOrCreate(path.split('/'), path.split('/').length)
    node.files = ds.files
    node.total_nodes = ds.total_nodes
  }

  // Propagate hasPhp and aggregate file counts bottom-up
  function propagate(n: TreeNode): void {
    for (const c of n.children) propagate(c)
    if (n.files > 0) n.hasPhp = true
    for (const c of n.children) {
      if (c.hasPhp) {
        n.hasPhp = true
        n.files += c.files
        n.total_nodes += c.total_nodes
      }
    }
  }
  propagate(root)

  function sortChildren(n: TreeNode) {
    n.children.sort((a, b) => a.name.localeCompare(b.name))
    n.children.forEach(sortChildren)
  }
  sortChildren(root)

  return root
}

// Aggregate nodes for all leaf dirs under a given path prefix
function aggregateNodes(prefix: string, dirStats: Record<string, DirStats>): Record<string, number> {
  const result: Record<string, number> = {}
  for (const [path, ds] of Object.entries(dirStats)) {
    if (prefix === '' || path === prefix || path.startsWith(prefix + '/')) {
      for (const [k, v] of Object.entries(ds.nodes)) {
        result[k] = (result[k] ?? 0) + v
      }
    }
  }
  return result
}

function aggregateFiles(prefix: string, dirStats: Record<string, DirStats>): number {
  let count = 0
  for (const [path, ds] of Object.entries(dirStats)) {
    if (prefix === '' || path === prefix || path.startsWith(prefix + '/')) {
      count += ds.files
    }
  }
  return count
}

function aggregateTotalNodes(prefix: string, dirStats: Record<string, DirStats>): number {
  let total = 0
  for (const [path, ds] of Object.entries(dirStats)) {
    if (prefix === '' || path === prefix || path.startsWith(prefix + '/')) {
      total += ds.total_nodes
    }
  }
  return total
}

// ── DirTree component ─────────────────────────────────────────────────────────

interface DirTreeProps {
  node: TreeNode
  selected: string
  onSelect: (path: string) => void
  depth?: number
}

const TEST_RE = /^tests?$|^specs?$|^__tests__$/i

function isTestDir(name: string): boolean {
  return TEST_RE.test(name)
}

function DirTreeNode({ node, selected, onSelect, depth = 0 }: DirTreeProps) {
  const [open, setOpen] = useState(depth < 2)
  const isSelected = node.path === selected
  const hasChildren = node.children.length > 0
  const { hasPhp } = node
  const isTest = isTestDir(node.name)

  let rowClass = 'dir-tree-row'
  if (isSelected) rowClass += ' dir-tree-row--selected'
  if (!hasPhp) rowClass += ' dir-tree-row--empty'
  if (isTest) rowClass += ' dir-tree-row--test'

  return (
    <div className="dir-tree-item">
      <div
        className={rowClass}
        style={{ paddingLeft: `${depth * 14 + 8}px` }}
        onClick={() => {
          if (hasPhp) onSelect(node.path)
          if (hasChildren && hasPhp) setOpen(o => !o)
        }}
      >
        {hasChildren && hasPhp ? (
          <span className="dir-tree-chevron">{open ? '▾' : '▸'}</span>
        ) : (
          <span className="dir-tree-chevron dir-tree-chevron--leaf" />
        )}
        <span className="dir-tree-name">{node.name}</span>
        {isTest && <span className="dir-tree-badge dir-tree-badge--test">test</span>}
        {hasPhp && <span className="dir-tree-count">{formatNum(node.files)}</span>}
      </div>
      {open && hasChildren && hasPhp && (
        <div className="dir-tree-children">
          {node.children.map(child => (
            <DirTreeNode
              key={child.path}
              node={child}
              selected={selected}
              onSelect={onSelect}
              depth={depth + 1}
            />
          ))}
        </div>
      )}
    </div>
  )
}

// ── Main page ─────────────────────────────────────────────────────────────────

interface Props {
  slug: string
}

export function ProjectStatsPage({ slug }: Props) {
  const [project, setProject] = useState<ProjectData | null>(null)
  const [loading, setLoading] = useState(true)
  const [selectedDir, setSelectedDir] = useState('')
  const [sortKey, setSortKey] = useState<SortKey>('count')
  const [sortDesc, setSortDesc] = useState(true)
  const [filter, setFilter] = useState('')
  const [expanded, setExpanded] = useState<Set<string>>(new Set())

  useEffect(() => {
    setLoading(true)
    setSelectedDir('')
    import(`../../data/project-stats-${slug}.json`)
      .then(m => {
        setProject(m.default as ProjectData)
        setLoading(false)
      })
      .catch(() => setLoading(false))
  }, [slug])

  const toggle = useCallback((key: string) => {
    setExpanded(prev => {
      const next = new Set(prev)
      next.has(key) ? next.delete(key) : next.add(key)
      return next
    })
  }, [])

  // Nodes to display — aggregate from selected directory subtree
  const activeNodes = useMemo(() => {
    if (!project) return {}
    if (selectedDir === '') return project.nodes
    return aggregateNodes(selectedDir, project.dir_stats)
  }, [project, selectedDir])

  const activeTotalNodes = useMemo(() => {
    if (!project) return 0
    if (selectedDir === '') return project.total_nodes
    return aggregateTotalNodes(selectedDir, project.dir_stats)
  }, [project, selectedDir])

  const activeFiles = useMemo(() => {
    if (!project) return 0
    if (selectedDir === '') return project.files
    return aggregateFiles(selectedDir, project.dir_stats)
  }, [project, selectedDir])

  const dirTree = useMemo(() => project ? buildTree(project.dir_stats, project.all_dirs ?? []) : null, [project])

  const { parentRows, childMap } = useMemo(() => {
    const parents: string[] = []
    const children = new Map<string, string[]>()
    Object.keys(activeNodes).forEach(k => {
      if (isChildKey(k)) {
        const p = parentKey(k)
        if (!children.has(p)) children.set(p, [])
        children.get(p)!.push(k)
      } else {
        parents.push(k)
      }
    })
    return { parentRows: parents, childMap: children }
  }, [activeNodes])

  const rows = useMemo(() => {
    const query = filter.toLowerCase()
    return parentRows
      .filter(k => !query || k.toLowerCase().includes(query) ||
        (childMap.get(k) ?? []).some(c => c.toLowerCase().includes(query)))
      .map(k => ({ key: k, count: activeNodes[k] ?? 0 }))
      .sort((a, b) => {
        if (sortKey === 'name') return sortDesc ? (b.key < a.key ? -1 : 1) : (a.key < b.key ? -1 : 1)
        return sortDesc ? b.count - a.count : a.count - b.count
      })
  }, [parentRows, childMap, activeNodes, sortKey, sortDesc, filter])

  const maxCount = useMemo(() => Math.max(...rows.map(r => r.count), 1), [rows])

  function toggleSort(key: SortKey) {
    if (sortKey === key) setSortDesc(d => !d)
    else { setSortKey(key); setSortDesc(true) }
  }

  function SortIndicator({ k }: { k: SortKey }) {
    if (sortKey !== k) return <span className="cmp-sort-icon">⇅</span>
    return <span className="cmp-sort-icon active">{sortDesc ? '↓' : '↑'}</span>
  }

  if (loading) {
    return (
      <div className="page-project-stats">
        <div className="project-stats-header">
          <a className="project-stats-back" href="#stats">← All projects</a>
        </div>
        <div className="project-stats-loading">Loading…</div>
      </div>
    )
  }

  if (!project) {
    return (
      <div className="page-project-stats">
        <div className="project-stats-header">
          <a className="project-stats-back" href="#stats">← All projects</a>
          <h1 className="cmp-title">Project not found</h1>
        </div>
      </div>
    )
  }

  return (
    <div className="page-project-stats">
      <div className="project-stats-header">
        <a className="project-stats-back" href="#stats">← All projects</a>
        <div className="project-stats-title-row">
          <h1 className="project-stats-name">{project.name}</h1>
          <span className="project-stats-version">{project.version}</span>
          <a
            className="project-stats-repo-link"
            href={project.repo}
            target="_blank"
            rel="noreferrer"
          >
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
              <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
              <polyline points="15 3 21 3 21 9"/>
              <line x1="10" y1="14" x2="21" y2="3"/>
            </svg>
            {project.repo.replace('https://github.com/', '')}
          </a>
        </div>
      </div>

      <div className="project-stats-body">
        {/* Projects list */}
        <div className="project-stats-projects">
          <div className="dir-tree-label">Projects</div>
          <nav className="project-nav">
            {ALL_PROJECTS.map(p => (
              <a
                key={p.slug}
                className={`project-nav-item${p.slug === slug ? ' project-nav-item--active' : ''}`}
                href={routeToHash({ page: 'stats-project', slug: p.slug })}
              >
                {p.name}
              </a>
            ))}
          </nav>
        </div>

        {/* Directory tree */}
        <div className="project-stats-sidebar">
          <div className="dir-tree-label">Directories</div>
          <div className="dir-tree">
            {dirTree && dirTree.children.map(child => (
              <DirTreeNode
                key={child.path}
                node={child}
                selected={selectedDir}
                onSelect={setSelectedDir}
              />
            ))}
          </div>
        </div>

        {/* Right: stats table */}
        <div className="project-stats-main">
          <div className="project-stats-toolbar">
            <input
              className="cmp-filter"
              type="text"
              placeholder="Filter node types…"
              value={filter}
              onChange={e => setFilter(e.target.value)}
            />
            <span className="cmp-stat">
              <strong>{formatNum(activeFiles)}</strong> files
            </span>
            <span className="cmp-stat">
              <strong>{formatNum(activeTotalNodes)}</strong> nodes
            </span>
            {selectedDir && (
              <span className="project-stats-dir-badge">
                <code>{selectedDir}/</code>
              </span>
            )}
            <span className="cmp-count">{rows.length} node types</span>
          </div>

          <div className="cmp-table-wrap">
            <table className="cmp-table">
              <thead>
                <tr>
                  <th className="cmp-th cmp-th-name" onClick={() => toggleSort('name')}>
                    Node type <SortIndicator k="name" />
                  </th>
                  <th className="cmp-th cmp-th-bar" onClick={() => toggleSort('count')}>
                    Count <SortIndicator k="count" />
                  </th>
                  <th className="cmp-th cmp-th-diff">% of total</th>
                </tr>
              </thead>
              <tbody>
                {rows.map(row => {
                  const barWidth = (row.count / maxCount) * 100
                  const desc = NODE_DESCRIPTIONS[row.key]
                  const children = childMap.get(row.key)
                  const hasChildren = children && children.length > 0
                  const isOpen = expanded.has(row.key)

                  return [
                    <tr
                      key={row.key}
                      className={`cmp-row${hasChildren ? ' cmp-row--expandable' : ''}${isOpen ? ' cmp-row--open' : ''}`}
                      onClick={hasChildren ? () => toggle(row.key) : undefined}
                      title={desc}
                    >
                      <td className="cmp-td-name">
                        <span className="cmp-node-name">
                          {hasChildren && (
                            <span className="cmp-expand-icon" aria-hidden="true">
                              {isOpen ? '▾' : '▸'}
                            </span>
                          )}
                          {row.key}
                          {DOC_LINKS[row.key] && (
                            <a
                              className="cmp-doc-link"
                              href={DOC_LINKS[row.key]}
                              title={`View ${row.key} in docs`}
                              onClick={e => e.stopPropagation()}
                            >
                              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <polyline points="15 3 21 3 21 9"/>
                                <line x1="10" y1="14" x2="21" y2="3"/>
                              </svg>
                            </a>
                          )}
                        </span>
                        {desc && <span className="cmp-node-desc">{desc}</span>}
                      </td>
                      <td className="cmp-td-bar">
                        <div className="cmp-bar-wrap">
                          <div className="cmp-bar cmp-bar-left" style={{ width: `${barWidth}%` }} />
                        </div>
                        <span className="cmp-bar-label">{pct(row.count, activeTotalNodes)}</span>
                        <span className="cmp-bar-abs">{formatNum(row.count)}</span>
                      </td>
                      <td className="cmp-td-diff project-stats-pct">
                        {pct(row.count, activeTotalNodes)}
                      </td>
                    </tr>,

                    ...(isOpen && children ? children
                      .map(k => ({ key: k, count: activeNodes[k] ?? 0 }))
                      .sort((a, b) => b.count - a.count)
                      .map(child => {
                        const cBarW = row.count > 0 ? (child.count / row.count) * 100 : 0
                        const label = child.key.replace(/^.+? \(/, '(')
                        return (
                          <tr key={child.key} className="cmp-row cmp-row--child">
                            <td className="cmp-td-name">
                              <span className="cmp-node-name cmp-child-name">{label}</span>
                            </td>
                            <td className="cmp-td-bar">
                              <div className="cmp-bar-wrap">
                                <div className="cmp-bar cmp-bar-left" style={{ width: `${cBarW}%` }} />
                              </div>
                              <span className="cmp-bar-label">{pct(child.count, row.count)}</span>
                              <span className="cmp-bar-abs">{formatNum(child.count)}</span>
                            </td>
                            <td className="cmp-td-diff project-stats-pct">
                              {pct(child.count, activeTotalNodes)}
                            </td>
                          </tr>
                        )
                      }) : [])
                  ]
                })}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  )
}

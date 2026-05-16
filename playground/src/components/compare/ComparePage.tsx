import { useState, useMemo, useCallback } from 'react'
import { Select } from '../Select'
import rawStats from '../../data/project-stats.json'
import { astNodes } from '../../data/ast-nodes'
import { routeToHash } from '../../router'

interface ProjectStats {
  name: string
  slug: string
  repo: string
  version: string
  scanned_dirs: string[]
  files: number
  total_nodes: number
  nodes: Record<string, number>
}

const PROJECTS: ProjectStats[] = rawStats as unknown as ProjectStats[]

const DOC_LINKS: Record<string, string> = Object.fromEntries(
  astNodes.map(n => [n.name, `#docs/${n.id}`])
)

// Human-readable descriptions for node types
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

const PROJECT_DESC: Record<string, string> = {
  laravel:      'Full-stack web framework with expressive syntax. Powers a large share of the PHP ecosystem with its elegant ORM, routing, and service container.',
  symfony:      'Enterprise-grade component library and full-stack framework. Many PHP frameworks (Laravel, Drupal, Shopware) are built on Symfony components.',
  wordpress:    'The world\'s most widely deployed CMS. Powers ~43% of all websites. Core ships a large amount of procedural PHP alongside modern OOP.',
  drupal:       'Content management framework aimed at complex, structured content sites. Known for its powerful entity system and hook-based architecture.',
  phpunit:      'The de-facto standard testing framework for PHP. Pioneered test-driven development in the PHP community; its patterns shaped the entire ecosystem.',
  composer:     'Dependency manager for PHP — the equivalent of npm or Cargo. Nearly every modern PHP project relies on it to manage packages via Packagist.',
  codeigniter:  'Lightweight MVC framework with a small footprint and minimal configuration. Popular for building simple, fast web applications.',
  'doctrine-orm': 'Object-relational mapper built on the Data Mapper pattern. Provides a database abstraction layer used heavily in Symfony and other frameworks.',
  yii2:         'High-performance PHP framework with built-in caching, security, and scaffolding. Popular in Asia and enterprise environments.',
  cakephp:      'Convention-over-configuration MVC framework. One of the oldest PHP frameworks still actively maintained, known for rapid application development.',
}

type SortKey = 'name' | 'left' | 'right' | 'diff'

function formatNum(n: number): string {
  return n.toLocaleString()
}

const CHILD_RE = /^(.+) \([^)]+\)$/
const isChildKey = (key: string) => CHILD_RE.test(key)
const parentKey = (key: string) => key.replace(/ \([^)]+\)$/, '')

function ProjectInfoPopover({ project }: { project: ProjectStats }) {
  const desc = PROJECT_DESC[project.slug] ?? ''
  return (
    <div className="cmp-info-wrap">
      <span className="cmp-info-btn" aria-label={`Info about ${project.name}`}>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
          <circle cx="12" cy="12" r="10"/>
          <line x1="12" y1="16" x2="12" y2="12"/>
          <line x1="12" y1="8" x2="12.01" y2="8"/>
        </svg>
      </span>
      <div className="cmp-info-popover">
        <div className="cmp-info-popover-inner">
          <div className="cmp-info-name">{project.name}</div>
          {desc && <p className="cmp-info-desc">{desc}</p>}
          <div className="cmp-info-divider" />
          <div className="cmp-info-row">
            <span className="cmp-info-label">Version</span>
            <span className="cmp-info-value">{project.version}</span>
          </div>
          <div className="cmp-info-row">
            <span className="cmp-info-label">Repository</span>
            <a className="cmp-info-link" href={project.repo} target="_blank" rel="noreferrer">
              {project.repo.replace('https://github.com/', '')}
              <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true" style={{marginLeft: '3px', verticalAlign: 'middle'}}>
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                <polyline points="15 3 21 3 21 9"/>
                <line x1="10" y1="14" x2="21" y2="3"/>
              </svg>
            </a>
          </div>
          <div className="cmp-info-row">
            <span className="cmp-info-label">Scanned directories</span>
            <ul className="cmp-info-dir-list">
              {project.scanned_dirs.map(d => (
                <li key={d}><code>{d}/</code></li>
              ))}
            </ul>
          </div>
          <div className="cmp-info-row">
            <span className="cmp-info-label">Coverage</span>
            <span className="cmp-info-value">{formatNum(project.files)} PHP files · {formatNum(project.total_nodes)} nodes</span>
          </div>
        </div>
      </div>
    </div>
  )
}

function pct(n: number, total: number): string {
  if (total === 0) return '0%'
  return ((n / total) * 100).toFixed(2) + '%'
}

export function ComparePage() {
  const [leftSlug, setLeftSlug] = useState(PROJECTS[0].slug)
  const [rightSlug, setRightSlug] = useState(PROJECTS[1].slug)
  const [sortKey, setSortKey] = useState<SortKey>('left')
  const [sortDesc, setSortDesc] = useState(true)
  const [filter, setFilter] = useState('')
  const [expanded, setExpanded] = useState<Set<string>>(new Set())

  const left = PROJECTS.find(p => p.slug === leftSlug)!
  const right = PROJECTS.find(p => p.slug === rightSlug)!

  const toggle = useCallback((key: string) => {
    setExpanded(prev => {
      const next = new Set(prev)
      next.has(key) ? next.delete(key) : next.add(key)
      return next
    })
  }, [])

  const makeRow = useCallback((k: string) => ({
    key: k,
    leftCount: left.nodes[k] ?? 0,
    rightCount: right.nodes[k] ?? 0,
    leftPct: (left.nodes[k] ?? 0) / left.total_nodes,
    rightPct: (right.nodes[k] ?? 0) / right.total_nodes,
    diff: ((right.nodes[k] ?? 0) / right.total_nodes) - ((left.nodes[k] ?? 0) / left.total_nodes),
  }), [left, right])

  // All keys split into parents and children
  const { parentRows, childMap } = useMemo(() => {
    const allKeys = new Set([...Object.keys(left.nodes), ...Object.keys(right.nodes)])
    const parents: string[] = []
    const children = new Map<string, string[]>()

    allKeys.forEach(k => {
      if (isChildKey(k)) {
        const p = parentKey(k)
        if (!children.has(p)) children.set(p, [])
        children.get(p)!.push(k)
      } else {
        parents.push(k)
      }
    })

    return { parentRows: parents, childMap: children }
  }, [left, right])

  const rows = useMemo(() => {
    const query = filter.toLowerCase()
    return parentRows
      .filter(k => !query || k.toLowerCase().includes(query) ||
        (childMap.get(k) ?? []).some(c => c.toLowerCase().includes(query)))
      .map(makeRow)
      .sort((a, b) => {
        if (sortKey === 'name') return sortDesc ? (b.key < a.key ? -1 : 1) : (a.key < b.key ? -1 : 1)
        const va = sortKey === 'left' ? a.leftPct : sortKey === 'right' ? a.rightPct : Math.abs(a.diff)
        const vb = sortKey === 'left' ? b.leftPct : sortKey === 'right' ? b.rightPct : Math.abs(b.diff)
        return sortDesc ? vb - va : va - vb
      })
  }, [parentRows, childMap, makeRow, sortKey, sortDesc, filter])

  const maxPct = useMemo(
    () => Math.max(...rows.map(r => Math.max(r.leftPct, r.rightPct)), 0.001),
    [rows]
  )

  function toggleSort(key: SortKey) {
    if (sortKey === key) setSortDesc(d => !d)
    else { setSortKey(key); setSortDesc(true) }
  }

  function SortIndicator({ k }: { k: SortKey }) {
    if (sortKey !== k) return <span className="cmp-sort-icon">⇅</span>
    return <span className="cmp-sort-icon active">{sortDesc ? '↓' : '↑'}</span>
  }

  return (
    <div className="page-compare">
      <div className="cmp-selectors">
        <div className="cmp-project-card cmp-project-left">
          <div className="cmp-card-header">
            <div className="cmp-project-label">Project A</div>
            <div className="cmp-card-actions">
              <ProjectInfoPopover project={left} />
            </div>
          </div>
          <a
            className="cmp-project-name-link"
            href={routeToHash({ page: 'stats-project', slug: leftSlug })}
          >
            {left.name}
          </a>
          <div className="cmp-select-row">
            <Select
              className="cmp-select--left"
              value={leftSlug}
              onChange={setLeftSlug}
              options={PROJECTS.map(p => ({ value: p.slug, label: p.name }))}
              aria-label="Project A"
            />
          </div>
          <div className="cmp-project-stats">
            <span className="cmp-stat"><strong>{formatNum(left.files)}</strong> library files</span>
            <span className="cmp-stat"><strong>{formatNum(left.total_nodes)}</strong> nodes</span>
          </div>
        </div>

        <div className="cmp-vs">vs</div>

        <div className="cmp-project-card cmp-project-right">
          <div className="cmp-card-header">
            <div className="cmp-project-label">Project B</div>
            <div className="cmp-card-actions">
              <ProjectInfoPopover project={right} />
            </div>
          </div>
          <a
            className="cmp-project-name-link"
            href={routeToHash({ page: 'stats-project', slug: rightSlug })}
          >
            {right.name}
          </a>
          <div className="cmp-select-row">
            <Select
              className="cmp-select--right"
              value={rightSlug}
              onChange={setRightSlug}
              options={PROJECTS.map(p => ({ value: p.slug, label: p.name }))}
              aria-label="Project B"
            />
          </div>
          <div className="cmp-project-stats">
            <span className="cmp-stat"><strong>{formatNum(right.files)}</strong> library files</span>
            <span className="cmp-stat"><strong>{formatNum(right.total_nodes)}</strong> nodes</span>
          </div>
        </div>
      </div>

      <div className="cmp-controls">
        <input
          className="cmp-filter"
          type="text"
          placeholder="Filter node types…"
          value={filter}
          onChange={e => setFilter(e.target.value)}
        />
        <span className="cmp-count">{rows.length} node types</span>
      </div>

      <div className="cmp-table-wrap">
        <table className="cmp-table">
          <thead>
            <tr>
              <th className="cmp-th cmp-th-name" onClick={() => toggleSort('name')}>
                Node type <SortIndicator k="name" />
              </th>
              <th className="cmp-th cmp-th-bar cmp-th-left" onClick={() => toggleSort('left')}>
                {left.name} <SortIndicator k="left" />
              </th>
              <th className="cmp-th cmp-th-bar cmp-th-right" onClick={() => toggleSort('right')}>
                {right.name} <SortIndicator k="right" />
              </th>
              <th className="cmp-th cmp-th-diff" onClick={() => toggleSort('diff')}>
                Δ diff <SortIndicator k="diff" />
              </th>
            </tr>
          </thead>
          <tbody>
            {rows.map(row => {
              const leftWidth = (row.leftPct / maxPct) * 100
              const rightWidth = (row.rightPct / maxPct) * 100
              const diffSign = row.diff > 0 ? 'more' : row.diff < 0 ? 'less' : 'same'
              const diffPct = (Math.abs(row.diff) * 100).toFixed(2)
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
                      <div className="cmp-bar cmp-bar-left" style={{ width: `${leftWidth}%` }} />
                    </div>
                    <span className="cmp-bar-label">{pct(row.leftCount, left.total_nodes)}</span>
                    <span className="cmp-bar-abs">{formatNum(row.leftCount)}</span>
                  </td>
                  <td className="cmp-td-bar">
                    <div className="cmp-bar-wrap">
                      <div className="cmp-bar cmp-bar-right" style={{ width: `${rightWidth}%` }} />
                    </div>
                    <span className="cmp-bar-label">{pct(row.rightCount, right.total_nodes)}</span>
                    <span className="cmp-bar-abs">{formatNum(row.rightCount)}</span>
                  </td>
                  <td className={`cmp-td-diff cmp-diff-${diffSign}`}>
                    {row.diff === 0 ? '—' : `${row.diff > 0 ? '+' : '−'}${diffPct}%`}
                  </td>
                </tr>,

                ...(isOpen && children ? children
                  .map(makeRow)
                  .sort((a, b) => b.leftPct - a.leftPct)
                  .map(child => {
                    // bars relative to parent total
                    const cLeftW = row.leftCount > 0 ? (child.leftCount / row.leftCount) * 100 : 0
                    const cRightW = row.rightCount > 0 ? (child.rightCount / row.rightCount) * 100 : 0
                    const label = child.key.replace(/^.+? \(/, '(')
                    const cDiff = row.rightCount > 0 && row.leftCount > 0
                      ? (child.rightCount / row.rightCount) - (child.leftCount / row.leftCount)
                      : 0
                    const cDiffSign = cDiff > 0 ? 'more' : cDiff < 0 ? 'less' : 'same'
                    return (
                      <tr key={child.key} className="cmp-row cmp-row--child">
                        <td className="cmp-td-name">
                          <span className="cmp-node-name cmp-child-name">{label}</span>
                        </td>
                        <td className="cmp-td-bar">
                          <div className="cmp-bar-wrap">
                            <div className="cmp-bar cmp-bar-left" style={{ width: `${cLeftW}%` }} />
                          </div>
                          <span className="cmp-bar-label">{pct(child.leftCount, row.leftCount)}</span>
                          <span className="cmp-bar-abs">{formatNum(child.leftCount)}</span>
                        </td>
                        <td className="cmp-td-bar">
                          <div className="cmp-bar-wrap">
                            <div className="cmp-bar cmp-bar-right" style={{ width: `${cRightW}%` }} />
                          </div>
                          <span className="cmp-bar-label">{pct(child.rightCount, row.rightCount)}</span>
                          <span className="cmp-bar-abs">{formatNum(child.rightCount)}</span>
                        </td>
                        <td className={`cmp-td-diff cmp-diff-${cDiffSign}`}>
                          {cDiff === 0 ? '—' : `${cDiff > 0 ? '+' : '−'}${(Math.abs(cDiff) * 100).toFixed(1)}%`}
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
  )
}

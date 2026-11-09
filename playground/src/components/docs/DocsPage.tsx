import { useState, useMemo, useEffect, useRef } from 'react'
import { NodeCard } from './NodeCard'
import { DOC_GROUPS, orderedNodes, isAvailableIn } from './nodes'
import type { PhpVersion } from '../Toolbar'

interface Props {
  version: PhpVersion
}

const groupId = (group: string) => `group-${group.toLowerCase().replace(/[^a-z]+/g, '-')}`

export function DocsPage({ version }: Props) {
  const [searchTerm, setSearchTerm] = useState('')
  const [selectedGroups, setSelectedGroups] = useState<Set<string>>(new Set())
  const searchRef = useRef<HTMLInputElement>(null)

  const available = useMemo(() => orderedNodes.filter(n => isAvailableIn(n, version)), [version])
  const hiddenByVersion = orderedNodes.length - available.length

  const matching = useMemo(() => {
    const query = searchTerm.trim().toLowerCase()
    if (!query) return available
    return available.filter(node =>
      node.name.toLowerCase().includes(query) ||
      node.description.toLowerCase().includes(query) ||
      node.id.toLowerCase().includes(query) ||
      node.fields?.some(f => f.name.toLowerCase().includes(query)),
    )
  }, [available, searchTerm])

  const groupCounts = useMemo(() => {
    const counts: Record<string, number> = {}
    matching.forEach(node => { counts[node.group] = (counts[node.group] || 0) + 1 })
    return counts
  }, [matching])

  const sections = useMemo(() => {
    const visible = selectedGroups.size > 0 ? matching.filter(n => selectedGroups.has(n.group)) : matching
    return DOC_GROUPS
      .map(group => ({ group, nodes: visible.filter(n => n.group === group) }))
      .filter(s => s.nodes.length > 0)
  }, [matching, selectedGroups])

  const visibleCount = sections.reduce((sum, s) => sum + s.nodes.length, 0)
  const isFiltered = searchTerm.trim() !== '' || selectedGroups.size > 0

  useEffect(() => {
    const onKey = (e: KeyboardEvent) => {
      const target = e.target as HTMLElement
      if (e.key === '/' && !e.metaKey && !e.ctrlKey && !target.closest('input, textarea, [contenteditable]')) {
        e.preventDefault()
        searchRef.current?.focus()
      }
    }
    window.addEventListener('keydown', onKey)
    return () => window.removeEventListener('keydown', onKey)
  }, [])

  const toggleGroup = (group: string) => {
    const next = new Set(selectedGroups)
    if (next.has(group)) next.delete(group)
    else next.add(group)
    setSelectedGroups(next)
  }

  const clearFilters = () => {
    setSearchTerm('')
    setSelectedGroups(new Set())
  }

  return (
    <div className="page-docs">
      <div className="docs-inner">
        <header className="docs-header">
          <h1>AST Node Reference</h1>
          <p className="docs-subtitle">
            Every node the parser produces, with a PHP example and its fields.
            Hover a field to find it in the example, or open a node for full details.
          </p>
        </header>

        <div className="docs-controls">
          <div className="docs-search-wrap">
            <svg className="docs-search-icon" viewBox="0 0 16 16" aria-hidden="true">
              <circle cx="7" cy="7" r="4.5" fill="none" stroke="currentColor" strokeWidth="1.5" />
              <path d="M10.5 10.5 14 14" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round" />
            </svg>
            <input
              ref={searchRef}
              type="search"
              className="docs-search"
              placeholder="Search by name, description or field"
              value={searchTerm}
              onChange={e => setSearchTerm(e.target.value)}
              onKeyDown={e => { if (e.key === 'Escape') setSearchTerm('') }}
              aria-label="Search AST nodes"
            />
            {searchTerm ? (
              <button type="button" className="docs-search-clear" onClick={() => { setSearchTerm(''); searchRef.current?.focus() }}>
                Clear
              </button>
            ) : (
              <kbd className="docs-search-kbd" aria-hidden="true">/</kbd>
            )}
          </div>

          <div className="group-filter-buttons" role="group" aria-label="Filter by group">
            <button
              type="button"
              className="group-filter-btn"
              aria-pressed={selectedGroups.size === 0}
              onClick={() => setSelectedGroups(new Set())}
            >
              All <span className="group-filter-count">{matching.length}</span>
            </button>
            {DOC_GROUPS.map(group => {
              const count = groupCounts[group] || 0
              const pressed = selectedGroups.has(group)
              return (
                <button
                  key={group}
                  type="button"
                  className="group-filter-btn"
                  aria-pressed={pressed}
                  disabled={count === 0 && !pressed}
                  onClick={() => toggleGroup(group)}
                >
                  {group} <span className="group-filter-count">{count}</span>
                </button>
              )
            })}
          </div>

          <p className="docs-status" aria-live="polite">
            <span>
              {isFiltered
                ? <>Showing {visibleCount} of {available.length} nodes</>
                : <>{available.length} nodes in PHP {version}</>}
              {hiddenByVersion > 0 && (
                <span className="docs-status-note">
                  {' · '}{hiddenByVersion} more {hiddenByVersion === 1 ? 'needs' : 'need'} a newer PHP version (pick one in the top bar)
                </span>
              )}
            </span>
            {isFiltered && (
              <button type="button" className="docs-link-btn" onClick={clearFilters}>Clear filters</button>
            )}
          </p>
        </div>

        {sections.length === 0 ? (
          <div className="docs-empty">
            <p>
              {searchTerm.trim()
                ? <>No nodes match “{searchTerm.trim()}”{selectedGroups.size > 0 && ' in the selected groups'}.</>
                : 'No nodes in the selected groups.'}
            </p>
            <button type="button" className="docs-reset-btn" onClick={clearFilters}>Clear filters</button>
          </div>
        ) : (
          sections.map(({ group, nodes }) => (
            <section key={group} className="docs-group" aria-labelledby={groupId(group)}>
              <h2 id={groupId(group)} className="docs-group-title">
                {group} <span className="docs-group-count">{nodes.length}</span>
              </h2>
              <div className="node-grid">
                {nodes.map(node => <NodeCard key={node.id} node={node} />)}
              </div>
            </section>
          ))
        )}
      </div>
    </div>
  )
}

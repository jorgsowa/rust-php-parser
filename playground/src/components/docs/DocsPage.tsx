import { useState, useMemo } from 'react'
import { astNodes } from '../../data/ast-nodes'
import { NodeCard } from './NodeCard'
import type { PhpVersion } from '../Toolbar'

interface Props {
  version: PhpVersion
}

const SEMANTIC_GROUPS = [
  'Control Flow',
  'Define Code',
  'Output/Communication',
  'Variables & Values',
  'Operations',
  'Function/Method Calls',
  'Class/Object Operations',
  'Declarations',
  'Types',
  'Other Expressions',
  'Helpers'
]

export function DocsPage({ version }: Props) {
  const [searchTerm, setSearchTerm] = useState('')
  const [selectedGroups, setSelectedGroups] = useState<Set<string>>(new Set())

  const filteredNodes = useMemo(() => {
    let filtered = astNodes

    // Filter by PHP version
    filtered = filtered.filter(node => {
      if (!node.phpVersion) return true
      const nodeMinVersion = parseFloat(node.phpVersion)
      const currentVersion = parseFloat(version)
      return currentVersion >= nodeMinVersion
    })

    // Filter by groups (if any selected, only show those; if none selected, show all)
    if (selectedGroups.size > 0) {
      filtered = filtered.filter(node => selectedGroups.has(node.group))
    }

    if (searchTerm.trim()) {
      const query = searchTerm.toLowerCase()
      filtered = filtered.filter(node =>
        node.name.toLowerCase().includes(query) ||
        node.description.toLowerCase().includes(query) ||
        node.id.toLowerCase().includes(query)
      )
    }

    return filtered
  }, [searchTerm, selectedGroups, version])


  const groupCounts = useMemo(() => {
    const counts: Record<string, number> = {}
    astNodes.forEach(node => {
      counts[node.group] = (counts[node.group] || 0) + 1
    })
    return counts
  }, [])

  const toggleGroup = (group: string) => {
    const newGroups = new Set(selectedGroups)
    if (newGroups.has(group)) {
      newGroups.delete(group)
    } else {
      newGroups.add(group)
    }
    setSelectedGroups(newGroups)
  }

  const clearFilters = () => {
    setSearchTerm('')
    setSelectedGroups(new Set())
  }

  return (
    <div className="page-docs">
      <div className="docs-header">
        <h1>AST Node Reference</h1>
        <p className="docs-subtitle">Explore all PHP AST nodes with live examples</p>
      </div>

      <div className="docs-controls">
        <input
          type="text"
          className="docs-search"
          placeholder="🔍 Search nodes by name or description..."
          value={searchTerm}
          onChange={e => setSearchTerm(e.target.value)}
          aria-label="Search AST nodes"
        />

        <div className="docs-group-filters">
          <div className="group-filter-label">Filter by group:</div>
          <div className="group-filter-buttons">
            {SEMANTIC_GROUPS.map(group => (
              <button
                key={group}
                className={`group-filter-btn ${selectedGroups.has(group) ? 'active' : ''}`}
                onClick={() => toggleGroup(group)}
                title={`${group} (${groupCounts[group] || 0})`}
              >
                {group} ({groupCounts[group] || 0})
              </button>
            ))}
          </div>
          {selectedGroups.size > 0 && (
            <button className="docs-reset-filters-btn" onClick={clearFilters}>
              Clear filters
            </button>
          )}
        </div>
      </div>

      <div className="docs-results">
        {filteredNodes.length === 0 ? (
          <div className="docs-empty">
            <p>No nodes found matching your search.</p>
            <button className="docs-reset-btn" onClick={clearFilters}>
              Clear filters
            </button>
          </div>
        ) : (
          <div className="node-grid">
            {filteredNodes.map(node => (
              <NodeCard
                key={node.id}
                node={node}
                nodeLink={`#docs/${node.id}`}
              />
            ))}
          </div>
        )}
      </div>
    </div>
  )
}

import { useState, useMemo } from 'react'
import { astNodes, type AstNode } from '../../data/ast-nodes'
import { NodeCard } from './NodeCard'

interface Props {
  onVisualize: (code: string) => void
}

type Category = 'statement' | 'expression' | 'declaration' | 'type' | 'helper'

const CATEGORY_LABELS: Record<Category, string> = {
  statement: 'Statements',
  expression: 'Expressions',
  declaration: 'Declarations',
  type: 'Types',
  helper: 'Helpers'
}

export function DocsPage({ onVisualize }: Props) {
  const [searchTerm, setSearchTerm] = useState('')
  const [selectedCategory, setSelectedCategory] = useState<Category | null>(null)

  const filteredNodes = useMemo(() => {
    let filtered = astNodes

    if (selectedCategory) {
      filtered = filtered.filter(node => node.category === selectedCategory)
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
  }, [searchTerm, selectedCategory])

  const categories: Category[] = ['statement', 'expression', 'declaration', 'type', 'helper']
  const categoryCounts = useMemo(() => {
    const counts: Record<Category, number> = {
      statement: 0,
      expression: 0,
      declaration: 0,
      type: 0,
      helper: 0
    }
    astNodes.forEach(node => {
      counts[node.category]++
    })
    return counts
  }, [])

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

        <div className="docs-category-tabs">
          <button
            className={`category-tab ${selectedCategory === null ? 'active' : ''}`}
            onClick={() => setSelectedCategory(null)}
          >
            All ({astNodes.length})
          </button>
          {categories.map(cat => (
            <button
              key={cat}
              className={`category-tab ${selectedCategory === cat ? 'active' : ''}`}
              onClick={() => setSelectedCategory(cat)}
            >
              {CATEGORY_LABELS[cat]} ({categoryCounts[cat]})
            </button>
          ))}
        </div>
      </div>

      <div className="docs-results">
        {filteredNodes.length === 0 ? (
          <div className="docs-empty">
            <p>No nodes found matching your search.</p>
            <button
              className="docs-reset-btn"
              onClick={() => {
                setSearchTerm('')
                setSelectedCategory(null)
              }}
            >
              Clear filters
            </button>
          </div>
        ) : (
          <div className="node-grid">
            {filteredNodes.map(node => (
              <NodeCard
                key={node.id}
                node={node}
                onVisualize={onVisualize}
                nodeLink={`#docs/${node.id}`}
              />
            ))}
          </div>
        )}
      </div>
    </div>
  )
}

import { useState } from 'react'
import { type AstNode } from '../../data/ast-nodes'

interface Props {
  node: AstNode
  onVisualize: (code: string) => void
  nodeLink?: string
}

export function NodeCard({ node, onVisualize, nodeLink }: Props) {
  const [highlightedKeyword, setHighlightedKeyword] = useState<string | null>(null)
  const [showKeywordHighlight, setShowKeywordHighlight] = useState(false)

  const handleVisualize = () => {
    onVisualize(node.phpExample)
  }

  const renderExampleWithHighlight = () => {
    let code = node.phpExample

    // Escape HTML special characters first
    code = code
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;')

    // Highlight the main keyword when title is hovered
    if (node.keywordInExample && showKeywordHighlight) {
      const keyword = node.keywordInExample
      const regex = new RegExp(`\\b${keyword}\\b`, 'g')
      code = code.replace(regex, `<mark class="keyword">${keyword}</mark>`)
    }

    // Highlight field-specific patterns if a field is hovered
    if (highlightedKeyword && node.fieldHighlights && node.fieldHighlights[highlightedKeyword]) {
      const patterns = node.fieldHighlights[highlightedKeyword]
      patterns.forEach(pattern => {
        // Escape special regex characters in the pattern
        const escapedPattern = pattern.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')
        const regex = new RegExp(escapedPattern, 'g')
        code = code.replace(regex, `<mark class="field-highlight">${pattern}</mark>`)
      })
    }

    return (
      <pre
        className="example-code"
        dangerouslySetInnerHTML={{ __html: code }}
      />
    )
  }

  return (
    <div className="node-card">
      <div className="node-header">
        {nodeLink ? (
          <a
            href={nodeLink}
            className="node-name node-name-link"
            onMouseEnter={() => setShowKeywordHighlight(true)}
            onMouseLeave={() => setShowKeywordHighlight(false)}
            title={`View ${node.name} details`}
          >
            {node.name}
          </a>
        ) : (
          <h3
            className="node-name"
            onMouseEnter={() => setShowKeywordHighlight(true)}
            onMouseLeave={() => setShowKeywordHighlight(false)}
          >
            {node.name}
          </h3>
        )}
        <div className="node-meta">
          {node.phpVersion && (
            <span className="node-version">{node.phpVersion}</span>
          )}
          <button
            className="node-visualize-btn"
            onClick={handleVisualize}
            title="Load this example in the playground"
            aria-label={`Visualize ${node.name} in playground`}
          >
            ▶
          </button>
        </div>
      </div>

      <p className="node-description">{node.description}</p>

      <div className="node-example">
        {renderExampleWithHighlight()}
      </div>

      {node.fields && node.fields.length > 0 && (
        <div className="node-fields">
          <h4 className="fields-title">Fields</h4>
          <ul className="fields-list">
            {node.fields && node.fields.map((field, idx) => (
              <li
                key={idx}
                className="field-item"
                onMouseEnter={() => setHighlightedKeyword(field.name)}
                onMouseLeave={() => setHighlightedKeyword(null)}
              >
                <span className="field-name">{field.name}</span>
                <span className="field-type">{field.type}</span>
                {field.optional && <span className="field-optional">optional</span>}
                {field.description && (
                  <p className="field-desc">{field.description}</p>
                )}
              </li>
            ))}
          </ul>
        </div>
      )}
    </div>
  )
}

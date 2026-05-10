import { useState } from 'react'
import { type AstNode } from '../../data/ast-nodes'

interface Props {
  node: AstNode
  nodeLink?: string
}

export function NodeCard({ node, nodeLink }: Props) {
  const [highlightedKeyword, setHighlightedKeyword] = useState<string | null>(null)
  const [showKeywordHighlight, setShowKeywordHighlight] = useState(false)

  const handleCardClick = () => {
    if (nodeLink) {
      window.location.hash = nodeLink.replace(/^#/, '')
    }
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

    // Highlight the main keyword(s) when title is hovered
    if (node.keywordInExample && showKeywordHighlight) {
      const keywords = Array.isArray(node.keywordInExample)
        ? node.keywordInExample
        : [node.keywordInExample]
      keywords.forEach(keyword => {
        // HTML-escape the keyword to match the already-escaped code
        let htmlEscapedKeyword = keyword
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#39;')
        const escapedKeyword = htmlEscapedKeyword.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')
        const isSymbol = /^[{}\[\]()@<>?|#]$/.test(keyword) || /^(<{2,}|>{2,})$/.test(keyword)
        const pattern = isSymbol ? escapedKeyword : `\\b${escapedKeyword}\\b`
        const regex = new RegExp(pattern, 'g')
        code = code.replace(regex, `<mark class="keyword">${htmlEscapedKeyword}</mark>`)
      })
    }

    // Highlight field-specific patterns if a field is hovered
    if (highlightedKeyword && node.fieldHighlights && node.fieldHighlights[highlightedKeyword]) {
      const patterns = node.fieldHighlights[highlightedKeyword]
      // Collect all matches with positions to avoid overlapping highlights
      const matches: Array<{ start: number; end: number; pattern: string; htmlEscaped: string }> = []

      patterns.forEach(pattern => {
        // HTML-escape the pattern to match the already-escaped code
        let htmlEscapedPattern = pattern
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#39;')
        // Escape special regex characters in the pattern
        const escapedPattern = htmlEscapedPattern.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')
        const regex = new RegExp(escapedPattern, 'g')

        let match
        while ((match = regex.exec(code)) !== null) {
          matches.push({
            start: match.index,
            end: match.index + match[0].length,
            pattern: pattern,
            htmlEscaped: htmlEscapedPattern
          })
        }
      })

      // Sort by position and length (longest first at same position) to handle overlaps
      matches.sort((a, b) => {
        if (a.start !== b.start) return a.start - b.start
        return (b.end - b.start) - (a.end - a.start)
      })

      // Remove overlapping matches (keep longer ones)
      const nonOverlapping = matches.filter((match, i) => {
        for (let j = 0; j < i; j++) {
          const other = matches[j]
          if (other.start <= match.start && match.end <= other.end) {
            return false // This match overlaps with a longer one
          }
        }
        return true
      })

      // Apply highlights in reverse order to preserve positions
      nonOverlapping.reverse().forEach(match => {
        code = code.slice(0, match.start) +
               `<mark class="field-highlight">${match.htmlEscaped}</mark>` +
               code.slice(match.end)
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
    <div
      className={`node-card${nodeLink ? ' node-card--clickable' : ''}`}
      onClick={nodeLink ? handleCardClick : undefined}
    >
      <div className="node-header">
        <h3 className="node-name">
          {node.name}
        </h3>
        <div className="node-meta">
          {node.phpVersion && (
            <span className="node-version">{node.phpVersion}</span>
          )}
        </div>
      </div>

      <p className="node-description">{node.description}</p>

      <div className="node-example">
        {renderExampleWithHighlight()}
      </div>

      {node.keywordInExample && (
        <div
          className="node-keyword"
          onMouseEnter={() => setShowKeywordHighlight(true)}
          onMouseLeave={() => setShowKeywordHighlight(false)}
        >
          <span className="keyword-label">Keyword:</span>
          <code className="keyword-code">
            {Array.isArray(node.keywordInExample)
              ? node.keywordInExample.join(' / ')
              : node.keywordInExample}
          </code>
        </div>
      )}

      {node.fields && node.fields.length > 0 && (
        <div className="node-fields">
          <h4 className="fields-title">Fields</h4>
          <ul className="fields-list">
            {node.fields && node.fields.map((field, idx) => (
              <li
                key={idx}
                className="field-item"
                onMouseEnter={e => { e.stopPropagation(); setHighlightedKeyword(field.name) }}
                onMouseLeave={() => setHighlightedKeyword(null)}
                onClick={e => e.stopPropagation()}
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

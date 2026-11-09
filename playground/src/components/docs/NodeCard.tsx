import { useState, type MouseEvent } from 'react'
import type { AstNode } from '../../data/ast-nodes'
import { CodeExample, computeMarks } from './CodeExample'
import { nodeHref } from './nodes'

interface Props {
  node: AstNode
}

export function keywordLabel(node: AstNode): string | null {
  if (!node.keywordInExample) return null
  return Array.isArray(node.keywordInExample) ? node.keywordInExample.join(' ') : node.keywordInExample
}

export function NodeCard({ node }: Props) {
  const [field, setField] = useState<string | null>(null)
  const [showKeyword, setShowKeyword] = useState(false)
  const keyword = keywordLabel(node)

  const openNode = (e: MouseEvent) => {
    // Let people select example text without navigating away.
    if (window.getSelection()?.toString()) return
    if ((e.target as HTMLElement).closest('a')) return
    window.location.hash = nodeHref(node)
  }

  return (
    <article className="node-card" onClick={openNode}>
      <header className="node-card-head">
        <h3 className="node-name">
          <a href={nodeHref(node)}>{node.name}</a>
        </h3>
        {node.phpVersion && (
          <span className="node-version" title={`Requires PHP ${node.phpVersion}`}>
            PHP {node.phpVersion}
          </span>
        )}
      </header>

      <p className="node-description">{node.description}</p>

      <CodeExample code={node.phpExample} marks={computeMarks(node, showKeyword, field)} />

      {(keyword || (node.fields && node.fields.length > 0)) && (
        <ul className="node-chips" aria-label="Keyword and fields">
          {keyword && (
            <li
              className="node-chip node-chip--keyword"
              onMouseEnter={() => setShowKeyword(true)}
              onMouseLeave={() => setShowKeyword(false)}
            >
              {keyword}
            </li>
          )}
          {node.fields?.map(f => (
            <li
              key={f.name}
              className={`node-chip${node.fieldHighlights?.[f.name] ? ' node-chip--linked' : ''}`}
              title={`${f.type}${f.optional ? ' (optional)' : ''} — ${f.description}`}
              onMouseEnter={() => setField(f.name)}
              onMouseLeave={() => setField(null)}
            >
              {f.name}
              {f.optional && <span className="node-chip-optional" aria-label="optional">?</span>}
            </li>
          ))}
        </ul>
      )}
    </article>
  )
}

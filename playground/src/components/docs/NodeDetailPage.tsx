import { useState } from 'react'
import { astNodes } from '../../data/ast-nodes'
import { NodeCard } from './NodeCard'
interface Props {
  nodeId: string
  onVisualize: (code: string) => void
}

export function NodeDetailPage({ nodeId, onVisualize }: Props) {
  const node = astNodes.find(n => n.id === nodeId)
  const [copied, setCopied] = useState(false)

  if (!node) {
    return (
      <div className="page-docs-detail">
        <div className="docs-detail-header">
          <a href="#docs" className="docs-back-link">← Back to docs</a>
        </div>
        <div className="docs-detail-content">
          <p>Node not found: {nodeId}</p>
        </div>
      </div>
    )
  }

  const handleCopyLink = () => {
    const url = `${window.location.origin}${window.location.pathname}#docs/${nodeId}`
    navigator.clipboard.writeText(url)
    setCopied(true)
    setTimeout(() => setCopied(false), 2000)
  }

  const nodeIndex = astNodes.findIndex(n => n.id === nodeId)
  const prevNode = nodeIndex > 0 ? astNodes[nodeIndex - 1] : null
  const nextNode = nodeIndex < astNodes.length - 1 ? astNodes[nodeIndex + 1] : null

  return (
    <div className="page-docs-detail">
      <div className="docs-detail-header">
        <a href="#docs" className="docs-back-link">← Back to docs</a>

        <div className="docs-detail-nav-inline">
          {prevNode ? (
            <a href={`#docs/${prevNode.id}`} className="docs-nav-prev">
              ← {prevNode.name}
            </a>
          ) : (
            <span className="docs-nav-placeholder" />
          )}
          {nextNode ? (
            <a href={`#docs/${nextNode.id}`} className="docs-nav-next">
              {nextNode.name} →
            </a>
          ) : (
            <span className="docs-nav-placeholder" />
          )}
        </div>

        <div className="docs-detail-actions">
          <button
            className="node-visualize-btn"
            onClick={() => onVisualize(node.phpExample)}
            title="Load this example in the playground"
          >
            ▶ Try it
          </button>
          <button
            className="docs-copy-link-btn"
            onClick={handleCopyLink}
            title="Copy shareable link"
          >
            {copied ? '✓ Copied' : '🔗 Copy link'}
          </button>
        </div>
      </div>

      <div className="docs-detail-content">
        <div className="docs-detail-card">
          <NodeCard node={node} />
        </div>
      </div>
    </div>
  )
}

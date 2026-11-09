import { useState, useEffect, useRef, type ReactNode } from 'react'
import { CodeExample, computeMarks } from './CodeExample'
import { keywordLabel } from './NodeCard'
import { orderedNodes, isAvailableIn, nodeHref, nodeForTypeName } from './nodes'
import type { PhpVersion } from '../Toolbar'

interface Props {
  nodeId: string
  version: PhpVersion
  onVisualize: (code: string) => void
}

type CopyState = 'idle' | 'copied' | 'failed'

function linkedType(type: string, currentId: string): ReactNode[] {
  return type.split(/([A-Z]\w*)/).map((part, i) => {
    const target = i % 2 === 1 ? nodeForTypeName(part) : undefined
    return target && target.id !== currentId
      ? <a key={i} href={nodeHref(target)} title={`${target.name}: ${target.description}`}>{part}</a>
      : part
  })
}

export function NodeDetailPage({ nodeId, version, onVisualize }: Props) {
  const nodeIndex = orderedNodes.findIndex(n => n.id === nodeId)
  const node = nodeIndex === -1 ? null : orderedNodes[nodeIndex]
  const prevNode = nodeIndex > 0 ? orderedNodes[nodeIndex - 1] : null
  const nextNode = nodeIndex !== -1 && nodeIndex < orderedNodes.length - 1 ? orderedNodes[nodeIndex + 1] : null

  const [copy, setCopy] = useState<CopyState>('idle')
  const [field, setField] = useState<string | null>(null)
  const [showKeyword, setShowKeyword] = useState(false)
  const scrollRef = useRef<HTMLDivElement>(null)

  useEffect(() => {
    scrollRef.current?.scrollTo({ top: 0 })
    setField(null)
    setShowKeyword(false)
    setCopy('idle')
  }, [nodeId])

  useEffect(() => {
    const onKey = (e: KeyboardEvent) => {
      if (e.metaKey || e.ctrlKey || e.altKey || e.shiftKey) return
      if ((e.target as HTMLElement).closest('input, textarea, select, [contenteditable]')) return
      const target = e.key === 'ArrowLeft' ? prevNode : e.key === 'ArrowRight' ? nextNode : null
      if (target) window.location.hash = nodeHref(target)
    }
    window.addEventListener('keydown', onKey)
    return () => window.removeEventListener('keydown', onKey)
  }, [prevNode, nextNode])

  if (!node) {
    return (
      <div className="page-docs-detail">
        <div className="docs-detail-content">
          <div className="docs-article docs-not-found">
            <h1>Node not found</h1>
            <p>There is no AST node with the id <code>{nodeId}</code>.</p>
            <a href="#docs" className="docs-reset-btn">Browse all nodes</a>
          </div>
        </div>
      </div>
    )
  }

  const handleCopyLink = async () => {
    const url = `${window.location.origin}${window.location.pathname}${nodeHref(node)}`
    try {
      await navigator.clipboard.writeText(url)
      setCopy('copied')
    } catch {
      setCopy('failed')
    }
    setTimeout(() => setCopy('idle'), 2000)
  }

  const keyword = keywordLabel(node)
  const available = isAvailableIn(node, version)
  const hasLinkedFields = node.fields?.some(f => node.fieldHighlights?.[f.name])

  return (
    <div className="page-docs-detail">
      <div className="docs-detail-bar">
        <nav className="docs-breadcrumb" aria-label="Breadcrumb">
          <a href="#docs">Docs</a>
          <span aria-hidden="true">/</span>
          <span>{node.group}</span>
          <span aria-hidden="true">/</span>
          <span aria-current="page" className="docs-breadcrumb-current">{node.name}</span>
        </nav>
        <div className="docs-detail-actions">
          <button
            type="button"
            className="docs-btn docs-btn--primary"
            onClick={() => onVisualize(`<?php\n${node.phpExample}`)}
          >
            Open in playground
          </button>
          <button type="button" className="docs-btn" onClick={handleCopyLink} aria-live="polite">
            {copy === 'copied' ? 'Link copied' : copy === 'failed' ? 'Copy failed' : 'Copy link'}
          </button>
        </div>
      </div>

      <div className="docs-detail-content" ref={scrollRef}>
        <article className="docs-article">
          <header className="docs-article-head">
            <p className="docs-eyebrow">{node.group}</p>
            <h1>{node.name}</h1>
            <p className="docs-lead">{node.description}</p>
            {node.phpVersion && (
              <p className={`docs-notice${available ? '' : ' docs-notice--warn'}`}>
                {available
                  ? <>Available since PHP {node.phpVersion.replace('+', '')}.</>
                  : <>Requires PHP {node.phpVersion}. The selected version, PHP {version}, rejects this syntax.</>}
              </p>
            )}
          </header>

          <div className="docs-article-body">
            <section className="docs-example" aria-labelledby="docs-example-title">
              <h2 id="docs-example-title" className="docs-section-title">Example</h2>
              <CodeExample
                code={node.phpExample}
                marks={computeMarks(node, showKeyword, field)}
                className="example-code--large"
              />
              {keyword && (
                <button
                  type="button"
                  className="docs-keyword"
                  aria-pressed={showKeyword}
                  onMouseEnter={() => setShowKeyword(true)}
                  onMouseLeave={() => setShowKeyword(false)}
                  onFocus={() => setShowKeyword(true)}
                  onBlur={() => setShowKeyword(false)}
                >
                  <span className="docs-keyword-label">Keyword</span>
                  <code>{keyword}</code>
                </button>
              )}
            </section>

            {node.fields && node.fields.length > 0 && (
              <section className="docs-fields" aria-labelledby="docs-fields-title">
                <h2 id="docs-fields-title" className="docs-section-title">Fields</h2>
                {hasLinkedFields && (
                  <p className="docs-hint">Hover or focus a field to highlight it in the example.</p>
                )}
                <ul className="field-list">
                  {node.fields.map(f => {
                    const linked = Boolean(node.fieldHighlights?.[f.name])
                    const active = field === f.name
                    return (
                      <li
                        key={f.name}
                        className={`field-row${linked ? ' field-row--linked' : ''}${active ? ' field-row--active' : ''}`}
                        tabIndex={linked ? 0 : undefined}
                        onMouseEnter={linked ? () => setField(f.name) : undefined}
                        onMouseLeave={linked ? () => setField(null) : undefined}
                        onFocus={linked ? () => setField(f.name) : undefined}
                        onBlur={linked ? () => setField(null) : undefined}
                      >
                        <div className="field-sig">
                          <code className="field-name">{f.name}</code>
                          <code className="field-type">{linkedType(f.type, node.id)}</code>
                          {f.optional && <span className="field-optional">optional</span>}
                        </div>
                        {f.description && <p className="field-desc">{f.description}</p>}
                      </li>
                    )
                  })}
                </ul>
              </section>
            )}
          </div>

          <nav className="docs-pager" aria-label="Adjacent nodes">
            {prevNode ? (
              <a href={nodeHref(prevNode)} className="docs-pager-link">
                <span className="docs-pager-dir">← Previous</span>
                <span className="docs-pager-name">{prevNode.name}</span>
              </a>
            ) : <span />}
            {nextNode ? (
              <a href={nodeHref(nextNode)} className="docs-pager-link docs-pager-link--next">
                <span className="docs-pager-dir">Next →</span>
                <span className="docs-pager-name">{nextNode.name}</span>
              </a>
            ) : <span />}
          </nav>
        </article>
      </div>
    </div>
  )
}

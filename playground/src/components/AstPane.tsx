import { useState, useMemo } from 'react'
import type { ParseResult } from '../php_wasm'
import { JsonTree, type TreeState } from './JsonTree'

interface Props {
  output: ParseResult | null
  onHighlight?: (span: { start: number; end: number } | null) => void
}

type Mode = 'expanded' | 'collapsed'

export function AstPane({ output, onHighlight }: Props) {
  const [mode, setMode]               = useState<Mode>('expanded')
  const [exceptions, setExceptions]   = useState<Set<string>>(new Set())

  const state = useMemo<TreeState>(() => ({
    isExpanded(path) {
      return mode === 'expanded' ? !exceptions.has(path) : exceptions.has(path)
    },
    onToggle(path) {
      setExceptions(prev => {
        const next = new Set(prev)
        if (next.has(path)) next.delete(path)
        else next.add(path)
        return next
      })
    },
    onHighlight,
  }), [mode, exceptions, onHighlight])

  const collapseAll = () => { setMode('collapsed'); setExceptions(new Set()) }
  const expandAll   = () => { setMode('expanded');  setExceptions(new Set()) }

  const collapseActive = mode === 'collapsed' && exceptions.size === 0
  const expandActive   = mode === 'expanded'  && exceptions.size === 0

  return (
    <div className="panel">
      <div className="panel-header">
        <span>AST</span>
        <div className="panel-header-actions">
          <button className={`jt-btn${collapseActive ? ' jt-btn--active' : ''}`} onClick={collapseAll}>wrap all</button>
          <button className={`jt-btn${expandActive   ? ' jt-btn--active' : ''}`} onClick={expandAll}>unwrap all</button>
        </div>
      </div>
      <div className="panel-body">
        {output
          ? <JsonTree value={output.ast} state={state} />
          : <div className="out-code" />
        }
      </div>
    </div>
  )
}

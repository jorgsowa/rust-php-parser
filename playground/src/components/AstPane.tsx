import { useState, useMemo } from 'react'
import type { ParseResult } from '../php_wasm'
import { JsonTree, type TreeState } from './JsonTree'

interface Props {
  output: ParseResult | null
}

type Mode = 'default' | 'all-wrapped' | 'all-unwrapped'

export function AstPane({ output }: Props) {
  const [mode, setMode]           = useState<Mode>('default')
  const [exceptions, setExceptions] = useState<Set<string>>(new Set())

  const state = useMemo<TreeState>(() => ({
    isExpanded(path, isSpan) {
      switch (mode) {
        case 'default':      return isSpan ? exceptions.has(path) : !exceptions.has(path)
        case 'all-wrapped':  return exceptions.has(path)
        case 'all-unwrapped': return !exceptions.has(path)
      }
    },
    onToggle(path) {
      setExceptions(prev => {
        const next = new Set(prev)
        if (next.has(path)) next.delete(path)
        else next.add(path)
        return next
      })
    },
  }), [mode, exceptions])

  const wrapAll   = () => { setMode('all-wrapped');   setExceptions(new Set()) }
  const unwrapAll = () => { setMode('all-unwrapped'); setExceptions(new Set()) }

  const wrapActive   = mode === 'all-wrapped'   && exceptions.size === 0
  const unwrapActive = mode === 'all-unwrapped' && exceptions.size === 0

  return (
    <div className="panel">
      <div className="panel-header">
        <span>AST</span>
        <div className="panel-header-actions">
          <button className={`jt-btn${wrapActive   ? ' jt-btn--active' : ''}`} onClick={wrapAll}>wrap all</button>
          <button className={`jt-btn${unwrapActive ? ' jt-btn--active' : ''}`} onClick={unwrapAll}>unwrap all</button>
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

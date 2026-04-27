import type { ParseResult } from '../php_wasm'

type Tab = 'formatted' | 'ast' | 'errors'

interface Props {
  output: ParseResult | null
  activeTab: Tab
  onTabChange: (t: Tab) => void
}

export function OutputPane({ output, activeTab, onTabChange }: Props) {
  const errorCount = output?.errors.length ?? 0

  return (
    <div className="output-panel">
      <div className="tab-bar" role="tablist">
        {(['ast', 'formatted', 'errors'] as Tab[]).map(tab => (
          <button
            key={tab}
            role="tab"
            aria-selected={activeTab === tab}
            className={`tab ${activeTab === tab ? 'active' : ''}`}
            onClick={() => onTabChange(tab)}
          >
            {tab === 'ast'       && 'AST'}
            {tab === 'formatted' && 'Formatted'}
            {tab === 'errors'    && (
              <>
                Errors
                {errorCount > 0 && <span className="err-badge">{errorCount}</span>}
              </>
            )}
          </button>
        ))}
      </div>

      <div className="tab-content" role="tabpanel">
        {activeTab === 'ast' && (
          <pre className="out-code">
            {output ? JSON.stringify(output.ast, null, 2) : ''}
          </pre>
        )}

        {activeTab === 'formatted' && (
          <pre className="out-code">{output?.formatted ?? ''}</pre>
        )}

        {activeTab === 'errors' && (
          <div className="errors-wrap">
            {errorCount === 0 ? (
              <div className="no-errors">
                <span className="no-errors-icon">✓</span>
                No parse errors
              </div>
            ) : (
              output?.errors.map((err, i) => (
                <div key={i} className="err-item">
                  <div className="err-msg">{err.message}</div>
                  <div className="err-loc">offset {err.start}–{err.end}</div>
                </div>
              ))
            )}
          </div>
        )}
      </div>
    </div>
  )
}

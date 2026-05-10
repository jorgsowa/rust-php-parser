import type { ParseResult } from '../php_wasm'

interface Props {
  output: ParseResult | null
  variant?: 'panel' | 'workspace'
}

export function ErrorPanel({ output, variant = 'panel' }: Props) {
  const errors = output?.errors ?? []

  if (errors.length === 0) return null

  const wrapperClass = variant === 'workspace' ? 'workspace-error-list' : 'panel-section panel-section--errors'

  return (
    <div className={wrapperClass}>
      {errors.map((err, i) => (
        <div key={i} className="err-item">
          <div className="err-msg">{err.message}</div>
          <div className="err-loc">offset {err.start}–{err.end}</div>
        </div>
      ))}
    </div>
  )
}

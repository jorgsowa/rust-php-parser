import type { ReactNode } from 'react'

export interface TreeState {
  isExpanded: (path: string, isSpan: boolean) => boolean
  onToggle: (path: string) => void
}

type Line = { indent: number; content: ReactNode }

const PX = 14

function isSpanObj(val: unknown): val is { start: number; end: number } {
  if (!val || typeof val !== 'object' || Array.isArray(val)) return false
  const o = val as Record<string, unknown>
  return (
    Object.keys(o).length === 2 &&
    typeof o.start === 'number' &&
    typeof o.end === 'number'
  )
}

// Returns a short label for a collapsed compound value.
function summary(value: unknown): string {
  if (Array.isArray(value)) return String(value.length)
  if (!value || typeof value !== 'object') return ''
  const obj = value as Record<string, unknown>
  const keys = Object.keys(obj)
  // Single-key enum variant wrapper: { VariantName: … }
  if (keys.length === 1) return keys[0]
  // AST node: { kind: { VariantName: … }, span: … }
  const kind = obj.kind
  if (kind && typeof kind === 'object' && !Array.isArray(kind)) {
    const kk = Object.keys(kind as object)
    if (kk.length === 1) return kk[0]
  }
  return ''
}

function Collapsed({ label, bracket, onClick }: { label: string; bracket: string; onClick: () => void }) {
  return (
    <span className="jt-toggle" onClick={onClick} title="Unwrap">
      ▸{label ? ` ${label} ` : ' '}{bracket}
    </span>
  )
}

function Chevron({ label, onClick }: { label: string; onClick: () => void }) {
  return (
    <span className="jt-toggle jt-toggle--open" onClick={onClick} title="Wrap">
      ▾{label ? ` ${label}` : ''}
    </span>
  )
}

function buildLines(
  value: unknown,
  indent: number,
  state: TreeState,
  path: string,
  key?: string,
  comma?: boolean,
): Line[] {
  const K = key != null
    ? <><span className="jt-key">{key}</span><span className="jt-punct">: </span></>
    : null
  const C = comma ? <span className="jt-punct">,</span> : null

  // Primitives
  if (value === null)
    return [{ indent, content: <>{K}<span className="jt-null">null</span>{C}</> }]
  if (typeof value === 'boolean')
    return [{ indent, content: <>{K}<span className="jt-kw">{String(value)}</span>{C}</> }]
  if (typeof value === 'number')
    return [{ indent, content: <>{K}<span className="jt-num">{value}</span>{C}</> }]
  if (typeof value === 'string')
    return [{ indent, content: <>{K}<span className="jt-str">"{value}"</span>{C}</> }]

  const toggle = () => state.onToggle(path)

  // Span objects — special collapsed form
  if (isSpanObj(value)) {
    const expanded = state.isExpanded(path, true)
    if (!expanded) {
      return [{
        indent,
        content: (
          <>{K}<span className="jt-span" onClick={toggle} title="Unwrap span">
            span({value.start}..{value.end})
          </span>{C}</>
        ),
      }]
    }
    return [
      { indent, content: <>{K}<span className="jt-span jt-span--on" onClick={toggle} title="Wrap span">▾ span</span><span className="jt-punct"> {'{'}</span></> },
      { indent: indent + 1, content: <><span className="jt-key">start</span><span className="jt-punct">: </span><span className="jt-num">{value.start}</span><span className="jt-punct">,</span></> },
      { indent: indent + 1, content: <><span className="jt-key">end</span><span className="jt-punct">: </span><span className="jt-num">{value.end}</span></> },
      { indent, content: <><span className="jt-punct">{'}'}</span>{C}</> },
    ]
  }

  // Arrays
  if (Array.isArray(value)) {
    if (value.length === 0)
      return [{ indent, content: <>{K}<span className="jt-punct">[]</span>{C}</> }]

    const expanded = state.isExpanded(path, false)
    if (!expanded) {
      return [{
        indent,
        content: <>{K}<Collapsed label={summary(value)} bracket={`[${value.length}]`} onClick={toggle} />{C}</>,
      }]
    }
    const lines: Line[] = [{
      indent,
      content: <>{K}<Chevron label="" onClick={toggle} /><span className="jt-punct">[</span></>,
    }]
    value.forEach((item, i) => {
      lines.push(...buildLines(item, indent + 1, state, `${path}.${i}`, undefined, i < value.length - 1))
    })
    lines.push({ indent, content: <><span className="jt-punct">]</span>{C}</> })
    return lines
  }

  // Objects
  const obj = value as Record<string, unknown>
  const entries = Object.entries(obj)

  if (entries.length === 0)
    return [{ indent, content: <>{K}<span className="jt-punct">{'{}'}</span>{C}</> }]

  const expanded = state.isExpanded(path, false)
  const label = summary(obj)

  if (!expanded) {
    return [{
      indent,
      content: <>{K}<Collapsed label={label} bracket="{ … }" onClick={toggle} />{C}</>,
    }]
  }
  const lines: Line[] = [{
    indent,
    content: <>{K}<Chevron label={label} onClick={toggle} /><span className="jt-punct"> {'{'}</span></>,
  }]
  entries.forEach(([k, v], i) => {
    lines.push(...buildLines(v, indent + 1, state, `${path}.${k}`, k, i < entries.length - 1))
  })
  lines.push({ indent, content: <><span className="jt-punct">{'}'}</span>{C}</> })
  return lines
}

interface Props {
  value: unknown
  state: TreeState
}

export function JsonTree({ value, state }: Props) {
  const lines = buildLines(value, 0, state, '')
  return (
    <div className="out-code jt-root">
      {lines.map((line, i) => (
        <div key={i} style={{ paddingLeft: line.indent * PX }}>
          {line.content}
        </div>
      ))}
    </div>
  )
}

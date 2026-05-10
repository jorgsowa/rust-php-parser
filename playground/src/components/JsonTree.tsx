import type { ReactNode } from 'react'

export interface TreeState {
  isExpanded: (path: string) => boolean
  onToggle: (path: string) => void
  onHighlight?: (span: { start: number; end: number } | null) => void
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

function isAstNode(val: unknown): val is Record<string, unknown> {
  if (!val || typeof val !== 'object' || Array.isArray(val)) return false
  const obj = val as Record<string, unknown>
  // Require both a PascalCase-variant kind field AND a span — plain structs
  // like Program { stmts, span } or Arg { ..., span } have no kind and must
  // fall through to the plain-object path instead.
  return getVariantInfo(obj.kind) !== null && isSpanObj(obj.span)
}

function isPascalCase(key: string): boolean {
  const c = key.charCodeAt(0)
  return c >= 65 && c <= 90
}

function getVariantInfo(kind: unknown): { name: string; data: unknown } | null {
  if (!kind || typeof kind !== 'object' || Array.isArray(kind)) return null
  const keys = Object.keys(kind as object)
  if (keys.length !== 1 || !isPascalCase(keys[0])) return null
  return { name: keys[0], data: (kind as Record<string, unknown>)[keys[0]] }
}

function Collapsed({ label, bracket, onClick }: { label: string; bracket: string; onClick: () => void }) {
  return (
    <span className="jt-toggle" onClick={onClick} title="Expand">
      ▸{label ? ` ${label} ` : ' '}{bracket}
    </span>
  )
}

function Chevron({ label, onClick }: { label: string; onClick: () => void }) {
  return (
    <span className="jt-toggle jt-toggle--open" onClick={onClick} title="Collapse">
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
  const toggle = () => state.onToggle(path)

  // Primitives
  if (value === null)
    return [{ indent, content: <>{K}<span className="jt-null">null</span>{C}</> }]
  if (typeof value === 'boolean')
    return [{ indent, content: <>{K}<span className="jt-kw">{String(value)}</span>{C}</> }]
  if (typeof value === 'number')
    return [{ indent, content: <>{K}<span className="jt-num">{value}</span>{C}</> }]
  if (typeof value === 'string')
    return [{ indent, content: <>{K}<span className="jt-str">"{value}"</span>{C}</> }]

  // Span — always compact inline with hover-to-highlight, no toggle
  if (isSpanObj(value)) {
    const span = value
    return [{
      indent,
      content: (
        <>{K}<span
          className="jt-span"
          onMouseEnter={() => state.onHighlight?.(span)}
          onMouseLeave={() => state.onHighlight?.(null)}
        >{span.start}..{span.end}</span>{C}</>
      ),
    }]
  }

  // Arrays — collapsible
  if (Array.isArray(value)) {
    if (value.length === 0)
      return [{ indent, content: <>{K}<span className="jt-punct">[]</span>{C}</> }]
    const expanded = state.isExpanded(path)
    if (!expanded) {
      return [{
        indent,
        content: <>{K}<Collapsed label="" bracket={`[${value.length}]`} onClick={toggle} />{C}</>,
      }]
    }
    const lines: Line[] = [{ indent, content: <>{K}<Chevron label="" onClick={toggle} /><span className="jt-punct">[</span></> }]
    value.forEach((item, i) => {
      lines.push(...buildLines(item, indent + 1, state, `${path}.${i}`, undefined, i < value.length - 1))
    })
    lines.push({ indent, content: <><span className="jt-punct">]</span>{C}</> })
    return lines
  }

  const obj = value as Record<string, unknown>
  const entries = Object.entries(obj)

  if (entries.length === 0)
    return [{ indent, content: <>{K}<span className="jt-punct">{'{}'}</span>{C}</> }]

  // AST node: object with a span field — collapsible, flattens kind.Variant fields
  if (isAstNode(obj)) {
    const span = obj.span as { start: number; end: number }
    const variant = getVariantInfo(obj.kind)
    const label = variant?.name ?? ''
    const expanded = state.isExpanded(path)
    const onEnter = () => state.onHighlight?.(span)
    const onLeave = () => state.onHighlight?.(null)

    if (!expanded) {
      return [{
        indent,
        content: (
          <span onMouseEnter={onEnter} onMouseLeave={onLeave}>
            {K}<Collapsed label={label} bracket="{ … }" onClick={toggle} />{C}
          </span>
        ),
      }]
    }

    const lines: Line[] = [{
      indent,
      content: (
        <span onMouseEnter={onEnter} onMouseLeave={onLeave}>
          {K}<Chevron label={label} onClick={toggle} /><span className="jt-punct"> {'{'}</span>
        </span>
      ),
    }]

    // variant is guaranteed non-null by isAstNode
    const { name: varName, data } = variant!
    if (data && typeof data === 'object' && !Array.isArray(data)) {
      // Object variant: flatten its fields directly into the node body.
      // Skip `span` — the outer node's span is always shown last and the
      // variant data's span would create a confusing duplicate.
      const variantEntries = Object.entries(data as Record<string, unknown>)
        .filter(([k]) => k !== 'span')
      variantEntries.forEach(([k, v], i) => {
        const hasMore = i < variantEntries.length - 1
        lines.push(...buildLines(v, indent + 1, state, `${path}.kind.${varName}.${k}`, k, hasMore || true))
      })
    } else if (data !== undefined && data !== null) {
      // Primitive or array variant value — show without key, span follows
      lines.push(...buildLines(data, indent + 1, state, `${path}.kind.${varName}`, undefined, true))
    }
    // Unit variant (no data): nothing between label and span

    // Any extra outer fields besides kind and span (rare in practice)
    entries.filter(([k]) => k !== 'kind' && k !== 'span').forEach(([k, v]) => {
      lines.push(...buildLines(v, indent + 1, state, `${path}.${k}`, k, true))
    })

    // Span always last, no trailing comma
    lines.push(...buildLines(span, indent + 1, state, `${path}.span`, 'span', false))
    lines.push({ indent, content: <><span className="jt-punct">{'}'}</span>{C}</> })
    return lines
  }

  // Single-key PascalCase enum variant — always expanded, key shown as type label
  if (entries.length === 1 && isPascalCase(entries[0][0])) {
    const [variantName, variantVal] = entries[0]
    const variantPath = `${path}.${variantName}`

    if (variantVal === null || typeof variantVal !== 'object') {
      // Primitive associated value: Variant("x")
      let primContent: ReactNode = null
      if (variantVal === null) primContent = <span className="jt-null">null</span>
      else if (typeof variantVal === 'boolean') primContent = <span className="jt-kw">{String(variantVal)}</span>
      else if (typeof variantVal === 'number') primContent = <span className="jt-num">{variantVal}</span>
      else if (typeof variantVal === 'string') primContent = <span className="jt-str">"{variantVal}"</span>
      return [{
        indent,
        content: <>{K}<span className="jt-variant">{variantName}</span><span className="jt-punct">(</span>{primContent}<span className="jt-punct">)</span>{C}</>,
      }]
    }

    if (Array.isArray(variantVal)) {
      if (variantVal.length === 0)
        return [{ indent, content: <>{K}<span className="jt-variant">{variantName}</span><span className="jt-punct"> []</span>{C}</> }]
      const expanded = state.isExpanded(variantPath)
      const toggleV = () => state.onToggle(variantPath)
      if (!expanded) {
        return [{
          indent,
          content: <>{K}<span className="jt-variant">{variantName}</span>{' '}<Collapsed label="" bracket={`[${variantVal.length}]`} onClick={toggleV} />{C}</>,
        }]
      }
      const lines: Line[] = [{ indent, content: <>{K}<span className="jt-variant">{variantName}</span>{' '}<Chevron label="" onClick={toggleV} /><span className="jt-punct">[</span></> }]
      variantVal.forEach((item, i) => {
        lines.push(...buildLines(item, indent + 1, state, `${variantPath}.${i}`, undefined, i < variantVal.length - 1))
      })
      lines.push({ indent, content: <><span className="jt-punct">]</span>{C}</> })
      return lines
    }

    // Object associated value — always expanded
    const variantEntries = Object.entries(variantVal as Record<string, unknown>)
    if (variantEntries.length === 0)
      return [{ indent, content: <>{K}<span className="jt-variant">{variantName}</span><span className="jt-punct"> {'{}'}</span>{C}</> }]
    const lines: Line[] = [{ indent, content: <>{K}<span className="jt-variant">{variantName}</span><span className="jt-punct"> {'{'}</span></> }]
    variantEntries.forEach(([k, v], i) => {
      lines.push(...buildLines(v, indent + 1, state, `${variantPath}.${k}`, k, i < variantEntries.length - 1))
    })
    lines.push({ indent, content: <><span className="jt-punct">{'}'}</span>{C}</> })
    return lines
  }

  // Plain object — always expanded, no toggle
  const lines: Line[] = [{ indent, content: <>{K}<span className="jt-punct">{'{'}</span></> }]
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

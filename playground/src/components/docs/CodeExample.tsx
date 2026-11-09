import { useMemo, useRef, useState, useLayoutEffect, type ReactNode } from 'react'
import { phpLanguage } from '@codemirror/lang-php'
import { highlightTree, tagHighlighter, tags as t } from '@lezer/highlight'
import type { AstNode } from '../../data/ast-nodes'

export type MarkKind = 'keyword' | 'field'

interface Range {
  start: number
  end: number
}

interface Token extends Range {
  cls: string
}

interface Mark extends Range {
  kind: MarkKind
}

const highlighter = tagHighlighter([
  { tag: [t.keyword, t.controlKeyword, t.operatorKeyword, t.definitionKeyword, t.moduleKeyword, t.modifier], class: 'tok-keyword' },
  { tag: [t.string, t.special(t.string)], class: 'tok-string' },
  { tag: [t.number, t.integer, t.float], class: 'tok-number' },
  { tag: [t.bool, t.null, t.atom], class: 'tok-atom' },
  { tag: [t.comment, t.lineComment, t.blockComment, t.docComment], class: 'tok-comment' },
  { tag: [t.function(t.variableName), t.function(t.name), t.definition(t.name), t.propertyName, t.attributeName], class: 'tok-fn' },
  { tag: [t.className, t.typeName, t.namespace], class: 'tok-type' },
  { tag: [t.special(t.variableName), t.escape], class: 'tok-special' },
  { tag: [t.operator, t.punctuation, t.bracket, t.meta], class: 'tok-punct' },
])

// The grammar starts in inline-HTML mode, so examples need an open tag to parse as PHP.
const OPEN_TAG = '<?php\n'

function tokenize(code: string): Token[] {
  const source = OPEN_TAG + code
  const tree = phpLanguage.parser.parse(source)
  const tokens: Token[] = []
  highlightTree(tree, highlighter, (from, to, cls) => {
    const start = Math.max(from - OPEN_TAG.length, 0)
    const end = to - OPEN_TAG.length
    if (end > start) tokens.push({ start, end, cls })
  }, OPEN_TAG.length, source.length)
  return tokens
}

const escapeRegExp = (s: string) => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')

function findAll(code: string, pattern: RegExp): Range[] {
  const out: Range[] = []
  for (const m of code.matchAll(pattern)) {
    if (m[0].length > 0) out.push({ start: m.index, end: m.index + m[0].length })
  }
  return out
}

function keywordRanges(code: string, keywords: string[]): Range[] {
  return keywords.flatMap(k => {
    const before = /^\w/.test(k) ? '\\b' : ''
    const after = /\w$/.test(k) ? '\\b' : ''
    return findAll(code, new RegExp(`${before}${escapeRegExp(k)}${after}`, 'g'))
  })
}

function patternRanges(code: string, patterns: string[]): Range[] {
  return patterns.flatMap(p => findAll(code, new RegExp(escapeRegExp(p), 'g')))
}

// Earliest match wins; at the same start the longest one does.
function dropOverlaps(ranges: Range[]): Range[] {
  const sorted = [...ranges].sort((a, b) => a.start - b.start || b.end - a.end)
  const out: Range[] = []
  let lastEnd = -1
  for (const r of sorted) {
    if (r.start >= lastEnd) {
      out.push(r)
      lastEnd = r.end
    }
  }
  return out
}

export function computeMarks(node: AstNode, showKeyword: boolean, field: string | null): Mark[] {
  const code = node.phpExample
  const patterns = field ? node.fieldHighlights?.[field] : undefined
  if (patterns) {
    return dropOverlaps(patternRanges(code, patterns)).map(r => ({ ...r, kind: 'field' }))
  }
  if (showKeyword && node.keywordInExample) {
    const keywords = Array.isArray(node.keywordInExample) ? node.keywordInExample : [node.keywordInExample]
    return dropOverlaps(keywordRanges(code, keywords)).map(r => ({ ...r, kind: 'keyword' }))
  }
  return []
}

function renderTokens(code: string, tokens: Token[], start: number, end: number): ReactNode[] {
  const out: ReactNode[] = []
  let pos = start
  for (const tok of tokens) {
    if (tok.end <= start) continue
    if (tok.start >= end) break
    const s = Math.max(tok.start, start)
    const e = Math.min(tok.end, end)
    if (s > pos) out.push(code.slice(pos, s))
    out.push(<span key={s} className={tok.cls}>{code.slice(s, e)}</span>)
    pos = e
  }
  if (pos < end) out.push(code.slice(pos, end))
  return out
}

interface Props {
  code: string
  marks?: Mark[]
  className?: string
}

// Fades the bottom edge while more code sits below the scroll fold.
function useClippedBottom() {
  const ref = useRef<HTMLPreElement>(null)
  const [clipped, setClipped] = useState(false)
  useLayoutEffect(() => {
    const el = ref.current
    if (!el) return
    const update = () => setClipped(el.scrollTop + el.clientHeight < el.scrollHeight - 1)
    update()
    el.addEventListener('scroll', update, { passive: true })
    const observer = new ResizeObserver(update)
    observer.observe(el)
    return () => {
      el.removeEventListener('scroll', update)
      observer.disconnect()
    }
  }, [])
  return { ref, clipped }
}

export function CodeExample({ code, marks = [], className }: Props) {
  const tokens = useMemo(() => tokenize(code), [code])
  const { ref, clipped } = useClippedBottom()

  const children: ReactNode[] = []
  let pos = 0
  for (const m of marks) {
    if (m.start > pos) children.push(...renderTokens(code, tokens, pos, m.start))
    children.push(
      <mark key={`m${m.start}`} className={`code-mark code-mark--${m.kind}`}>
        {renderTokens(code, tokens, m.start, m.end)}
      </mark>,
    )
    pos = m.end
  }
  children.push(...renderTokens(code, tokens, pos, code.length))

  return (
    <pre ref={ref} className={`example-code${clipped ? ' is-clipped' : ''}${className ? ` ${className}` : ''}`}>
      <code>{children}</code>
    </pre>
  )
}

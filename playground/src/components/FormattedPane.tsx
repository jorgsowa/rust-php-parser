import { useEffect, useRef } from 'react'
import { EditorView, lineNumbers } from '@codemirror/view'
import { EditorState } from '@codemirror/state'
import { foldGutter, syntaxHighlighting } from '@codemirror/language'
import { php } from '@codemirror/lang-php'
import { amberTheme, amberHighlight } from '../theme'
import type { ParseResult } from '../php_wasm'

interface Props {
  output: ParseResult | null
}

export function FormattedPane({ output }: Props) {
  const wrapRef = useRef<HTMLDivElement>(null)
  const viewRef = useRef<EditorView | null>(null)
  const errors = output?.errors ?? []

  useEffect(() => {
    if (!wrapRef.current) return
    const view = new EditorView({
      state: EditorState.create({
        doc: '',
        extensions: [
          lineNumbers(),
          foldGutter(),
          php({ plain: true }),
          amberTheme,
          syntaxHighlighting(amberHighlight),
          EditorView.lineWrapping,
          EditorView.editable.of(false),
        ],
      }),
      parent: wrapRef.current,
    })
    viewRef.current = view
    return () => { view.destroy(); viewRef.current = null }
  }, [])

  useEffect(() => {
    const view = viewRef.current
    if (!view) return
    const next = output?.formatted ?? ''
    const cur = view.state.doc.toString()
    if (next === cur) return
    view.dispatch({
      changes: { from: 0, to: cur.length, insert: next },
    })
  }, [output?.formatted])

  return (
    <div className="panel">
      <div className="panel-header">Formatted</div>
      <div className="panel-body">
        <div ref={wrapRef} className="editor-wrap" />
      </div>
    </div>
  )
}

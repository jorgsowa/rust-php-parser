import { useEffect, useRef, forwardRef, useImperativeHandle } from 'react'
import { EditorView, keymap, lineNumbers, highlightActiveLine, highlightActiveLineGutter } from '@codemirror/view'
import { EditorState } from '@codemirror/state'
import { indentOnInput, bracketMatching, foldGutter, syntaxHighlighting } from '@codemirror/language'
import { defaultKeymap, history, historyKeymap, indentWithTab } from '@codemirror/commands'
import { searchKeymap, highlightSelectionMatches } from '@codemirror/search'
import { php } from '@codemirror/lang-php'
import { amberTheme, amberHighlight } from '../theme'

interface Props {
  initialValue: string
  onChange: (val: string) => void
}

export interface EditorHandle {
  loadCode(code: string): void
}

export const EditorPane = forwardRef<EditorHandle, Props>(function EditorPane({ initialValue, onChange }, ref) {
  const wrapRef = useRef<HTMLDivElement>(null)
  const viewRef = useRef<EditorView | null>(null)

  useEffect(() => {
    if (!wrapRef.current) return
    const view = new EditorView({
      state: EditorState.create({
        doc: initialValue,
        extensions: [
          lineNumbers(),
          highlightActiveLineGutter(),
          highlightActiveLine(),
          history(),
          indentOnInput(),
          bracketMatching(),
          foldGutter(),
          highlightSelectionMatches(),
          php({ plain: true }),
          amberTheme,
          syntaxHighlighting(amberHighlight),
          keymap.of([indentWithTab, ...defaultKeymap, ...historyKeymap, ...searchKeymap]),
          EditorView.lineWrapping,
          EditorView.updateListener.of(update => {
            if (update.docChanged) onChange(update.state.doc.toString())
          }),
        ],
      }),
      parent: wrapRef.current,
    })
    viewRef.current = view
    return () => view.destroy()
    // initialValue only used for first render; onChange is stable from useCallback
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [])

  useImperativeHandle(ref, () => ({
    loadCode(code: string) {
      const view = viewRef.current
      if (!view) return
      view.dispatch({
        changes: {
          from: 0,
          to: view.state.doc.length,
          insert: code
        }
      })
    }
  }))

  return <div ref={wrapRef} className="editor-wrap" />
})

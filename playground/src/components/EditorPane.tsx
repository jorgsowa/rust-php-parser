import { useEffect, useRef, forwardRef, useImperativeHandle } from 'react'
import { EditorView, keymap, lineNumbers, highlightActiveLine, highlightActiveLineGutter, Decoration } from '@codemirror/view'
import { EditorState, StateField, StateEffect } from '@codemirror/state'
import { indentOnInput, bracketMatching, foldGutter, syntaxHighlighting } from '@codemirror/language'
import { defaultKeymap, history, historyKeymap, indentWithTab } from '@codemirror/commands'
import { searchKeymap, highlightSelectionMatches } from '@codemirror/search'
import { php } from '@codemirror/lang-php'
import { amberTheme, amberHighlight } from '../theme'

interface Props {
  initialValue: string
  onChange: (val: string) => void
  highlight?: { start: number; end: number } | null
}

export interface EditorHandle {
  loadCode(code: string): void
}

const setHighlight = StateEffect.define<{ start: number; end: number } | null>()

const highlightField = StateField.define({
  create: () => ({ start: -1, end: -1 }),
  update: (value, tr) => {
    for (const effect of tr.effects) {
      if (effect.is(setHighlight)) return effect.value ?? { start: -1, end: -1 }
    }
    return value
  },
  provide: f => EditorView.decorations.from(f, value => {
    if (value.start < 0) return Decoration.none
    const mark = Decoration.mark({ class: 'cm-highlight-span' })
    return Decoration.set([mark.range(value.start, value.end)])
  }),
})

export const EditorPane = forwardRef<EditorHandle, Props>(function EditorPane({ initialValue, onChange, highlight }, ref) {
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
          highlightField,
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

  useEffect(() => {
    const view = viewRef.current
    if (!view) return
    view.dispatch({
      effects: setHighlight.of(highlight ?? null),
    })
  }, [highlight])

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

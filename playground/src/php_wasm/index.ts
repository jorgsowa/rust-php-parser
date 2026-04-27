export interface ParseResult {
  ast: unknown
  errors: { message: string; start: number; end: number }[]
  formatted: string
}

export interface PhpWasm {
  parse(source: string, version?: string): ParseResult
  format(source: string): string
  parserVersion: string
  buildCommit: string
  isReal: boolean
}

const mock: PhpWasm = {
  isReal: false,
  parserVersion: '—',
  buildCommit: '—',
  parse(source) {
    return {
      ast: { note: 'Run wasm-pack to enable real parsing — see README' },
      errors: [],
      formatted: source,
    }
  },
  format(source) { return source },
}

let _resolved: PhpWasm | null = null
let _promise: Promise<PhpWasm> | null = null

export function loadPhpWasm(): Promise<PhpWasm> {
  if (_resolved) return Promise.resolve(_resolved)
  if (_promise) return _promise
  _promise = (async () => {
    try {
      const base = window.location.href.replace(/[^/]*$/, '')
      // eslint-disable-next-line @typescript-eslint/no-explicit-any
      const m: any = await import(/* @vite-ignore */ `${base}php_wasm/php_wasm.js`)
      await m.default()
      _resolved = {
        isReal: true,
        parserVersion: m.parser_version?.() ?? 'unknown',
        buildCommit: m.build_commit?.() ?? 'unknown',
        parse(s, v) { return m.parse(s, v) },
        format(s) { return m.format(s) },
      }
    } catch {
      _resolved = mock
    }
    return _resolved!
  })()
  return _promise
}

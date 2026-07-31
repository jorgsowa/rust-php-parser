import { type Route } from '../router'
import { Select } from './Select'

export const PHP_VERSIONS = ['7.4', '8.0', '8.1', '8.2', '8.3', '8.4', '8.5', '8.6'] as const
export type PhpVersion = (typeof PHP_VERSIONS)[number]
export type WasmStatus = 'loading' | 'ready' | 'mock'

interface Props {
  version: PhpVersion
  onVersionChange: (v: PhpVersion) => void
  wasmStatus: WasmStatus
  route: Route
}

const WASM_LABEL: Record<WasmStatus, string> = {
  loading: 'loading…',
  ready:   'wasm',
  mock:    'mock',
}

export function Toolbar({ version, onVersionChange, wasmStatus, route }: Props) {
  return (
    <header className="toolbar">
      <div className="toolbar-brand">
        <span className="brand-logo">php</span>
        <span className="brand-sep">/</span>
        <span className="brand-sub">parser playground</span>

      </div>

      <div className="toolbar-nav">
        <a
          href="#"
          className={`nav-tab ${route.page === 'playground' ? 'active' : ''}`}
          title="Interactive playground"
        >
          Playground
        </a>
        <a
          href="#docs"
          className={`nav-tab ${route.page === 'docs' || route.page === 'docs-node' ? 'active' : ''}`}
          title="AST node reference"
        >
          Docs
        </a>
        <a
          href="#stats"
          className={`nav-tab ${route.page === 'stats' || route.page === 'stats-project' ? 'active' : ''}`}
          title="Project Stats — AST node usage across popular PHP projects"
        >
          Project Stats
        </a>
      </div>

      <div className="toolbar-controls">
        <Select
          className="version-select"
          value={version}
          onChange={v => onVersionChange(v as PhpVersion)}
          aria-label="PHP version"
          options={PHP_VERSIONS.map(v => ({ value: v, label: `PHP ${v}` }))}
        />

        <span className={`wasm-pill ${wasmStatus}`} title={
          wasmStatus === 'ready'   ? 'Rust parser running in WebAssembly' :
          wasmStatus === 'mock'    ? 'WASM not loaded — build with wasm-pack' :
          'Initialising WebAssembly…'
        }>
          {WASM_LABEL[wasmStatus]}
        </span>

        <a
          className="toolbar-github-link"
          href="https://github.com/jorgsowa/rust-php-parser"
          target="_blank"
          rel="noreferrer"
          title="View source on GitHub"
          aria-label="View source on GitHub"
        >
          <svg width="18" height="18" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
            <path fillRule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
          </svg>
        </a>
      </div>
    </header>
  )
}

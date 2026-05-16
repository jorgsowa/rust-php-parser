import { type Route } from '../router'
import { Select } from './Select'

export const PHP_VERSIONS = ['7.4', '8.0', '8.1', '8.2', '8.3', '8.4', '8.5'] as const
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
          className={`nav-tab ${route.page === 'stats' || route.page === 'stats-project' || route.page === 'compare' ? 'active' : ''}`}
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
      </div>
    </header>
  )
}

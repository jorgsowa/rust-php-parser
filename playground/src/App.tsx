import { useState, useEffect, useCallback, useRef } from 'react'
import { loadPhpWasm, type ParseResult } from './php_wasm'
import { Toolbar, type PhpVersion, type WasmStatus } from './components/Toolbar'
import { EditorPane } from './components/EditorPane'
import { AstPane } from './components/AstPane'
import { FormattedPane } from './components/FormattedPane'

const INITIAL_CODE = `<?php

declare(strict_types=1);

function fibonacci(int $n): int {
    if ($n <= 1) return $n;
    return fibonacci($n - 1) + fibonacci($n - 2);
}

$result = fibonacci(10);
echo "fib(10) = {$result}\\n";

// Arrow functions (PHP 7.4+)
$numbers = [1, 2, 3, 4, 5];
$squared = array_map(fn($x) => $x ** 2, $numbers);

// Named arguments (PHP 8.0+)
$sliced = array_slice(array: $squared, offset: 1, length: 3);
print_r($sliced);

// Enum (PHP 8.1+)
enum Status: string {
    case Active   = 'active';
    case Inactive = 'inactive';

    public function label(): string {
        return match($this) {
            Status::Active   => 'Active',
            Status::Inactive => 'Inactive',
        };
    }
}

echo Status::Active->label();
`

export default function App() {
  const [code, setCode]             = useState(INITIAL_CODE)
  const [version, setVersion]       = useState<PhpVersion>('8.4')
  const [output, setOutput]         = useState<ParseResult | null>(null)
  const [wasmStatus, setWasmStatus]       = useState<WasmStatus>('loading')
  const [parserVersion, setParserVersion] = useState<string>('')
  const [buildCommit, setBuildCommit]     = useState<string>('')

  // Two dividers: left edge of divider 1 and divider 2, as % of workspace width
  const [div1, setDiv1] = useState(33)
  const [div2, setDiv2] = useState(66)

  const workspaceRef = useRef<HTMLDivElement>(null)
  const debounceRef  = useRef<ReturnType<typeof setTimeout> | null>(null)
  const codeRef      = useRef(code)
  const versionRef   = useRef(version)
  useEffect(() => { codeRef.current = code }, [code])
  useEffect(() => { versionRef.current = version }, [version])

  useEffect(() => {
    loadPhpWasm().then(w => {
      setWasmStatus(w.isReal ? 'ready' : 'mock')
      setParserVersion(w.parserVersion)
      setBuildCommit(w.buildCommit)
    })
  }, [])

  const runParse = useCallback((src: string, ver: PhpVersion) => {
    loadPhpWasm().then(w => {
      try { setOutput(w.parse(src, ver)) }
      catch (e) { console.error('[php-wasm] parse error:', e) }
    })
  }, [])

  // Code change → debounce
  useEffect(() => {
    if (debounceRef.current) clearTimeout(debounceRef.current)
    debounceRef.current = setTimeout(() => runParse(code, versionRef.current), 300)
    return () => { if (debounceRef.current) clearTimeout(debounceRef.current) }
  }, [code, runParse])

  // Version change → immediate
  useEffect(() => {
    if (debounceRef.current) clearTimeout(debounceRef.current)
    runParse(codeRef.current, version)
  }, [version, runParse])

  // Generic divider drag factory
  const makeDividerDrag = useCallback((
    which: 1 | 2,
    setA: (v: number) => void,
    getOther: () => number,
  ) => (e: React.MouseEvent) => {
    e.preventDefault()
    const onMove = (ev: MouseEvent) => {
      const ws = workspaceRef.current
      if (!ws) return
      const { left, width } = ws.getBoundingClientRect()
      const pct = ((ev.clientX - left) / width) * 100
      const other = getOther()
      if (which === 1) setA(Math.max(10, Math.min(pct, other - 15)))
      else             setA(Math.max(getOther() + 15, Math.min(pct, 90)))
    }
    const onUp = () => {
      window.removeEventListener('mousemove', onMove)
      window.removeEventListener('mouseup', onUp)
    }
    window.addEventListener('mousemove', onMove)
    window.addEventListener('mouseup', onUp)
  }, [])

  const onDiv1Down = makeDividerDrag(1, setDiv1, () => div2)
  const onDiv2Down = makeDividerDrag(2, setDiv2, () => div1)

  const errorCount = output?.errors.length ?? 0

  const col1 = div1
  const col2 = div2 - div1
  const col3 = 100 - div2

  return (
    <div className="app">
      <Toolbar version={version} onVersionChange={setVersion} wasmStatus={wasmStatus} />

      <div className="workspace" ref={workspaceRef}>
        <div className="pane" style={{ width: `${col1}%` }}>
          <EditorPane initialValue={INITIAL_CODE} onChange={setCode} />
        </div>

        <div className="divider" onMouseDown={onDiv1Down} role="separator" />

        <div className="pane" style={{ width: `${col2}%` }}>
          <AstPane output={output} />
        </div>

        <div className="divider" onMouseDown={onDiv2Down} role="separator" />

        <div className="pane" style={{ width: `${col3}%` }}>
          <FormattedPane output={output} />
        </div>
      </div>

      <div className="statusbar">
        <span className="statusbar-item">PHP {version}</span>
        <span className="statusbar-item">
          {wasmStatus === 'loading' && 'initialising…'}
          {wasmStatus === 'ready'   && 'rust · wasm'}
          {wasmStatus === 'mock'    && 'mock mode'}
        </span>
        {errorCount > 0 && (
          <span className="statusbar-item has-errors">
            {errorCount} parse error{errorCount !== 1 ? 's' : ''}
          </span>
        )}
        <span className="statusbar-spacer" />
        <span className="statusbar-item">{code.split('\n').length} lines</span>
        {parserVersion && (
          <a
            className="statusbar-item statusbar-link"
            href={`https://github.com/jorgsowa/rust-php-parser/releases/tag/v${parserVersion}`}
            target="_blank"
            rel="noreferrer"
            title="Release notes"
          >v{parserVersion}</a>
        )}
        {buildCommit && buildCommit !== '—' && (
          <a
            className="statusbar-item statusbar-commit statusbar-link"
            href={`https://github.com/jorgsowa/rust-php-parser/commit/${buildCommit}`}
            target="_blank"
            rel="noreferrer"
            title="View commit"
          >{buildCommit}</a>
        )}
      </div>
    </div>
  )
}

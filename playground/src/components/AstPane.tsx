import type { ParseResult } from '../php_wasm'

interface Props {
  output: ParseResult | null
}

export function AstPane({ output }: Props) {
  return (
    <div className="panel">
      <div className="panel-header">AST</div>
      <div className="panel-body">
        <pre className="out-code out-code--wrap">
          {output ? JSON.stringify(output.ast, null, 2) : ''}
        </pre>
      </div>
    </div>
  )
}

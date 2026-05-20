===source===
<?php `cmd é

===errors===
unterminated string literal
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "cmd é\n"
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected end of file, expecting "`" in Standard input code on line 2

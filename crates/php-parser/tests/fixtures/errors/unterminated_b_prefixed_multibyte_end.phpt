===source===
<?php b"héllo

===errors===
unterminated string literal
expected ';' after expression
===php_error===
PHP Parse error:  syntax error, unexpected end of file, expecting variable or "${" or "{$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "héllo\n"
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}

===source===
<?php foo /* bar */
===errors===
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "foo"
          },
          "span": {
            "start": 6,
            "end": 9
          }
        }
      },
      "span": {
        "start": 6,
        "end": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 9
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1

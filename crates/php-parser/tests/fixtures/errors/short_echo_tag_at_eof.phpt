===source===
a<?=
===errors===
expected expression, found end of file
===php_error===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "InlineHtml": "a"
      },
      "span": {
        "start": 0,
        "end": 1
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": "Error",
            "span": {
              "start": 4,
              "end": 4
            }
          }
        ]
      },
      "span": {
        "start": 1,
        "end": 4
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 4
  }
}

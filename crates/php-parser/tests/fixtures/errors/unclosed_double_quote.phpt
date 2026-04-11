===source===
<?php "unclosed string
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
            "String": "unclosed strin"
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}

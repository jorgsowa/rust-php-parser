===source===
<?php switch ($a) { ;; case 1: }
===errors===
Only one ';' may precede the first case of a switch
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "case" or "default" or "}" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 14,
              "end": 16
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 28,
                  "end": 29
                }
              },
              "body": [],
              "span": {
                "start": 23,
                "end": 30
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}

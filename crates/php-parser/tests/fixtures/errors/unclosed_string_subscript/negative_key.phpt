===source===
<?php
echo "$a[-1";
===errors===
unclosed '[' in string interpolation
===php_error===
PHP Parse error:  syntax error, unexpected double-quote mark, expecting "]" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 12,
                      "end": 14
                    }
                  }
                },
                {
                  "Literal": "[-1"
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 18
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}

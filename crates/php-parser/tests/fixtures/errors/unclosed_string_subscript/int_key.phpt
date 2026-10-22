===source===
<?php
echo "$a[0";
===errors===
unclosed '[' in string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '"', expecting ']' in Standard input code on line 2
===php_error >=8.0===
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
                  "Literal": "[0"
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 17
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}

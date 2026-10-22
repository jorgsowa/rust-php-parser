===source===
<?php
echo "$a[$b";
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
                  "Literal": "["
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 15,
                      "end": 17
                    }
                  }
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

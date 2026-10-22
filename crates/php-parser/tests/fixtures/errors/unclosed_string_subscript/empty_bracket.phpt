===source===
<?php
echo "$a[";
===errors===
unclosed '[' in string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '"', expecting '-' or identifier (T_STRING) or variable (T_VARIABLE) or number (T_NUM_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected double-quote mark, expecting "-" or identifier or variable or number in Standard input code on line 2
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
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 16
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}

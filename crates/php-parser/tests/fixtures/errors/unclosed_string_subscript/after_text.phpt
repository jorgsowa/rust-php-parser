===source===
<?php
echo "a $a[k and more";
===errors===
unclosed '[' in string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '' (T_ENCAPSED_AND_WHITESPACE), expecting ']' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected string content "", expecting "]" in Standard input code on line 2
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
                  "Literal": "a "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 14,
                      "end": 16
                    }
                  }
                },
                {
                  "Literal": "[k and more"
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 28
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}

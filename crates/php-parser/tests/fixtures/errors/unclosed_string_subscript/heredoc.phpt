===source===
<?php
echo <<<X
$a[k
X;
===errors===
unclosed '[' in string interpolation
===php_error===
PHP Parse error:  syntax error, unexpected string content "", expecting "]" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Heredoc": {
                "label": "X",
                "parts": [
                  {
                    "Expr": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 16,
                        "end": 18
                      }
                    }
                  },
                  {
                    "Literal": "[k"
                  }
                ]
              }
            },
            "span": {
              "start": 11,
              "end": 22
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}

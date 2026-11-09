===source===
<?php
$x = <<<EOT
    a \{$b
  c
    EOT;
===errors===
Invalid body indentation level
===php_error===
PHP Parse error:  Invalid body indentation level (expecting an indentation level of at least 4) in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a \\{"
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 26,
                            "end": 28
                          }
                        }
                      },
                      {
                        "Literal": "\nc"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 40
          }
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}

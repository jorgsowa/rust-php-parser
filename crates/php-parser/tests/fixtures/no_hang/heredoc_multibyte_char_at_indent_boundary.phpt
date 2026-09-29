===source===
<?php
$x = <<<END
    $b
abc؛
    END;
===errors===
Invalid body indentation level
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
                    "label": "END",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 22,
                            "end": 24
                          }
                        }
                      },
                      {
                        "Literal": "\nabc؛"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 38
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
===php_error===
PHP Parse error:  Invalid body indentation level (expecting an indentation level of at least 4) in Standard input code on line 4

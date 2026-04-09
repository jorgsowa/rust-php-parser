===source===
<?php $x = <<<EOT
Hello $name!
EOT;
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
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "Hello "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "name"
                          },
                          "span": {
                            "start": 24,
                            "end": 29,
                            "start_line": 2,
                            "start_col": 6
                          }
                        }
                      },
                      {
                        "Literal": "!"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}

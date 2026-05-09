===source===
<?php
$命令 = "ls -la";
$结果 = `$命令`;
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
                  "Variable": "命令"
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "ls -la"
                },
                "span": {
                  "start": 16,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "结果"
                },
                "span": {
                  "start": 26,
                  "end": 33
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "命令"
                        },
                        "span": {
                          "start": 37,
                          "end": 44
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 36,
                  "end": 45
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 45
          }
        }
      },
      "span": {
        "start": 26,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}

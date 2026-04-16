===source===
<?php switch () { case 1: break; } if (true) { echo 'ok'; }
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": "Error",
            "span": {
              "start": 14,
              "end": 15
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 23,
                  "end": 24
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 26,
                    "end": 32
                  }
                }
              ],
              "span": {
                "start": 18,
                "end": 32
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 39,
              "end": 43
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "ok"
                        },
                        "span": {
                          "start": 52,
                          "end": 56
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 47,
                    "end": 57
                  }
                }
              ]
            },
            "span": {
              "start": 45,
              "end": 59
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 35,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 1

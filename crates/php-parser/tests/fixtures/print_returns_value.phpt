===source===
<?php $x = print 'hello'; if (print 'check') {}
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
                  "Print": {
                    "kind": {
                      "String": "hello"
                    },
                    "span": {
                      "start": 17,
                      "end": 24,
                      "start_line": 1,
                      "start_col": 17
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 24,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Print": {
                "kind": {
                  "String": "check"
                },
                "span": {
                  "start": 36,
                  "end": 43,
                  "start_line": 1,
                  "start_col": 36
                }
              }
            },
            "span": {
              "start": 30,
              "end": 43,
              "start_line": 1,
              "start_col": 30
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 45,
              "end": 47,
              "start_line": 1,
              "start_col": 45
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 26,
        "end": 47,
        "start_line": 1,
        "start_col": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}

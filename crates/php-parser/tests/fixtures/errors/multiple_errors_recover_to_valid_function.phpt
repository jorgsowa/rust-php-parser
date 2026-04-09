===source===
<?php
$a = ;
$b = ;
function healthy(): string { return 'ok'; }
===errors===
expected expression
expected expression
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Error",
                "span": {
                  "start": 11,
                  "end": 12,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 13,
                  "end": 15,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Error",
                "span": {
                  "start": 18,
                  "end": 19,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 13,
            "end": 19,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 13,
        "end": 20,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "healthy",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "String": "ok"
                  },
                  "span": {
                    "start": 56,
                    "end": 60,
                    "start_line": 4,
                    "start_col": 36
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 62,
                "start_line": 4,
                "start_col": 29
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "string"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 40,
                  "end": 46,
                  "start_line": 4,
                  "start_col": 20
                }
              }
            },
            "span": {
              "start": 40,
              "end": 46,
              "start_line": 4,
              "start_col": 20
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 20,
        "end": 63,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}

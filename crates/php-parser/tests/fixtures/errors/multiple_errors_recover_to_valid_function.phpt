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
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Error",
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
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
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Error",
                "span": {
                  "start": 18,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 13,
            "end": 19
          }
        }
      },
      "span": {
        "start": 13,
        "end": 19
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
                    "end": 60
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 61
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
                  "end": 46
                }
              }
            },
            "span": {
              "start": 40,
              "end": 46
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 20,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}

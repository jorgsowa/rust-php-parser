===source===
<?php <<<EOT
Content
===errors===
expected expression
expected expression
expected ';' after expression
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": "Error",
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "op": "ShiftLeft",
                    "right": {
                      "kind": "Error",
                      "span": {
                        "start": 8,
                        "end": 9
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Less",
              "right": {
                "kind": {
                  "Identifier": "EOT"
                },
                "span": {
                  "start": 9,
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
        "end": 13
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "Content"
          },
          "span": {
            "start": 13,
            "end": 20
          }
        }
      },
      "span": {
        "start": 13,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}

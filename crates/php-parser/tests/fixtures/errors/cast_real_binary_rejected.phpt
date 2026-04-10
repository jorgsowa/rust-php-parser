===source===
<?php
$a = (real) 1.5;
$b = (binary) "hello";
===errors===
the (real) cast is no longer supported, use (float) instead
the (binary) cast is not supported, use (string) instead
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
                "kind": {
                  "Cast": [
                    "Float",
                    {
                      "kind": {
                        "Float": 1.5
                      },
                      "span": {
                        "start": 18,
                        "end": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
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
                  "start": 23,
                  "end": 25
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Cast": [
                    "String",
                    {
                      "kind": {
                        "String": "hello"
                      },
                      "span": {
                        "start": 37,
                        "end": 44
                      }
                    }
                  ]
                },
                "span": {
                  "start": 28,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 44
          }
        }
      },
      "span": {
        "start": 23,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}

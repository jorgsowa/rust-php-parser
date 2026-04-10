===source===
<?php $x = <<<EOT
hello
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": "Error",
                            "span": {
                              "start": 11,
                              "end": 13
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": "Error",
                            "span": {
                              "start": 13,
                              "end": 14
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 14
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Identifier": "EOT"
                      },
                      "span": {
                        "start": 14,
                        "end": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "hello"
          },
          "span": {
            "start": 18,
            "end": 23
          }
        }
      },
      "span": {
        "start": 18,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}

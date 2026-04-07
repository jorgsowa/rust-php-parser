===source===
<?php ['x' => $x, 'y' => $y] = getPoint();
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "x"
                        },
                        "span": {
                          "start": 7,
                          "end": 10
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 14,
                          "end": 16
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 16
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "y"
                        },
                        "span": {
                          "start": 18,
                          "end": 21
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "y"
                        },
                        "span": {
                          "start": 25,
                          "end": 27
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 18,
                        "end": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "getPoint"
                      },
                      "span": {
                        "start": 31,
                        "end": 39
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 31,
                  "end": 41
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 41
          }
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}

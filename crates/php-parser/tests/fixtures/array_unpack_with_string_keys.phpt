===source===
<?php $a = ['x' => 1]; $b = [...$a];
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "x"
                        },
                        "span": {
                          "start": 12,
                          "end": 15
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 19,
                          "end": 20
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 20
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 32,
                          "end": 34
                        }
                      },
                      "unpack": true,
                      "span": {
                        "start": 29,
                        "end": 34
                      }
                    }
                  ]
                },
                "span": {
                  "start": 28,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 35
          }
        }
      },
      "span": {
        "start": 23,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}

===source===
<?php
for ($i = 0; $i < 10; $i++) {
    function foo() {
        break;
    }
}
===errors===
Cannot 'break' 1 level
===php_error===
PHP Fatal error:  'break' not in the 'loop' or 'switch' context in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 11,
                      "end": 13
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 16,
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
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 19,
                      "end": 21
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 24,
                      "end": 26
                    }
                  }
                }
              },
              "span": {
                "start": 19,
                "end": 26
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 28,
                      "end": 30
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 28,
                "end": 32
              }
            }
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Function": {
                      "name": {
                        "name": "foo",
                        "span": {
                          "start": 49,
                          "end": 52
                        }
                      },
                      "params": [],
                      "body": [
                        {
                          "kind": {
                            "Break": null
                          },
                          "span": {
                            "start": 65,
                            "end": 71
                          }
                        }
                      ],
                      "return_type": null,
                      "by_ref": false,
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 40,
                    "end": 77
                  }
                }
              ]
            },
            "span": {
              "start": 34,
              "end": 79
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 79
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79
  }
}

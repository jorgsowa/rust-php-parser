===source===
<?php
function variadic(int ...$args): int {
    return 0;
}
function byref(&$ref): void {
    $ref = 1;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "variadic",
            "span": {
              "start": 15,
              "end": 23
            }
          },
          "params": [
            {
              "name": {
                "name": "args",
                "span": {
                  "start": 31,
                  "end": 36
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 24,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 27
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 24,
                "end": 36
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 56,
                    "end": 57
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 58
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "int"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 39,
                  "end": 42
                }
              }
            },
            "span": {
              "start": 39,
              "end": 42
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "byref",
            "span": {
              "start": 70,
              "end": 75
            }
          },
          "params": [
            {
              "name": {
                "name": "ref",
                "span": {
                  "start": 77,
                  "end": 81
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 76,
                "end": 81
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "ref"
                        },
                        "span": {
                          "start": 95,
                          "end": 99
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 102,
                          "end": 103
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 95,
                    "end": 103
                  }
                }
              },
              "span": {
                "start": 95,
                "end": 104
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 84,
                  "end": 88
                }
              }
            },
            "span": {
              "start": 84,
              "end": 88
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 61,
        "end": 106
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 106
  }
}

===description===
`#[A] function &f() {}` is a declaration, not a by-reference closure.
===source===
<?php
#[A] function &f() {}
#[A] function &(): int { return 1; };
#[A] function g() {}
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 86
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": true,
          "attributes": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 9
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": true,
              "params": [],
              "use_vars": [],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 47,
                      "end": 50
                    }
                  }
                },
                "span": {
                  "start": 47,
                  "end": 50
                }
              },
              "body": [
                {
                  "kind": {
                    "Return": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 60,
                        "end": 61
                      }
                    }
                  },
                  "span": {
                    "start": 53,
                    "end": 62
                  }
                }
              ],
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 30,
                    "end": 31
                  }
                }
              ]
            }
          },
          "span": {
            "start": 28,
            "end": 64
          }
        }
      },
      "span": {
        "start": 28,
        "end": 65
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 80,
              "end": 81
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 68,
                  "end": 69
                }
              },
              "args": [],
              "span": {
                "start": 68,
                "end": 69
              }
            }
          ]
        }
      },
      "span": {
        "start": 66,
        "end": 86
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 86
  }
}

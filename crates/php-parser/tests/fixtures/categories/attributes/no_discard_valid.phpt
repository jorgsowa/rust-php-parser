===source===
<?php
class A {
    #[NoDiscard] public function __CONSTRUCT2() {}
    #[NoDiscard] public function ok(): int { return 1; }
}
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 125
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 125
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__CONSTRUCT2",
                    "span": {
                      "start": 49,
                      "end": 61
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 31
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 31
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 66
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "ok",
                    "span": {
                      "start": 100,
                      "end": 102
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 106,
                          "end": 109
                        }
                      }
                    },
                    "span": {
                      "start": 106,
                      "end": 109
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
                            "start": 119,
                            "end": 120
                          }
                        }
                      },
                      "span": {
                        "start": 112,
                        "end": 121
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 73,
                          "end": 82
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 73,
                        "end": 82
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 71,
                "end": 123
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 125
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 125
  }
}

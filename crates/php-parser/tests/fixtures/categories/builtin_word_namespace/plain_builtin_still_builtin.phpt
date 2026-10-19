===source===
<?php
function f(int $a, string|null $b, ?array $c): void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 21,
                  "end": 23
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
                      "start": 17,
                      "end": 20
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 20
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 23
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 37,
                  "end": 39
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 25,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 31
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "null"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 32,
                            "end": 36
                          }
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 36
                      }
                    }
                  ]
                },
                "span": {
                  "start": 25,
                  "end": 36
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 25,
                "end": 39
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 48,
                  "end": 50
                }
              },
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 42,
                          "end": 47
                        }
                      }
                    },
                    "span": {
                      "start": 42,
                      "end": 47
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 47
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 41,
                "end": 50
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 53,
                  "end": 57
                }
              }
            },
            "span": {
              "start": 53,
              "end": 57
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
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}

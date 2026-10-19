===source===
<?php
function test(
    string /* param comment */ $x,
    int /* another comment */ $y
): string /* return comment */ {
    return $x;
}

class Test {
    public function method(
        string /* method param */ $param
    ): int /* method return */ {
        return 42;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 52,
                  "end": 54
                }
              },
              "type_hint": {
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
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 25,
                "end": 54
              }
            },
            {
              "name": {
                "name": "y",
                "span": {
                  "start": 86,
                  "end": 88
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
                      "start": 60,
                      "end": 63
                    }
                  }
                },
                "span": {
                  "start": 60,
                  "end": 63
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 60,
                "end": 88
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 133,
                    "end": 135
                  }
                }
              },
              "span": {
                "start": 126,
                "end": 136
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "string"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 92,
                  "end": 98
                }
              }
            },
            "span": {
              "start": 92,
              "end": 98
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 138
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 146,
              "end": 150
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
                    "name": "method",
                    "span": {
                      "start": 173,
                      "end": 179
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "param",
                        "span": {
                          "start": 215,
                          "end": 221
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 189,
                              "end": 195
                            }
                          }
                        },
                        "span": {
                          "start": 189,
                          "end": 195
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 189,
                        "end": 221
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
                          "start": 229,
                          "end": 232
                        }
                      }
                    },
                    "span": {
                      "start": 229,
                      "end": 232
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 42
                          },
                          "span": {
                            "start": 270,
                            "end": 272
                          }
                        }
                      },
                      "span": {
                        "start": 263,
                        "end": 273
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 157,
                "end": 279
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 140,
        "end": 281
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 281
  }
}

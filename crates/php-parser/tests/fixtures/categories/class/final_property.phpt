===source===
<?php
class C {
    final public int $x = 1;
    final protected string $y = "z";
    public final float $z = 1.0;
}
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 37,
                      "end": 39
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 36
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 43
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "y",
                    "span": {
                      "start": 72,
                      "end": 74
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_final": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 65,
                          "end": 71
                        }
                      }
                    },
                    "span": {
                      "start": 65,
                      "end": 71
                    }
                  },
                  "default": {
                    "kind": {
                      "String": "z"
                    },
                    "span": {
                      "start": 77,
                      "end": 80
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 80
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "z",
                    "span": {
                      "start": 105,
                      "end": 107
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "float"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 99,
                          "end": 104
                        }
                      }
                    },
                    "span": {
                      "start": 99,
                      "end": 104
                    }
                  },
                  "default": {
                    "kind": {
                      "Float": 1.0
                    },
                    "span": {
                      "start": 110,
                      "end": 113
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 86,
                "end": 113
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 116
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 116
  }
}

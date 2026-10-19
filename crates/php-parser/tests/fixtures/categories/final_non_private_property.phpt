===config===
min_php=8.4
===source===
<?php
class A {
    final protected $a;
    final public int $b;
    final private(set) public int $c;
    private int $d;
}
===ast===
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_final": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 38
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 61,
                      "end": 63
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
                          "start": 57,
                          "end": 60
                        }
                      }
                    },
                    "span": {
                      "start": 57,
                      "end": 60
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 63
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 99,
                      "end": 101
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private",
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
                          "start": 95,
                          "end": 98
                        }
                      }
                    },
                    "span": {
                      "start": 95,
                      "end": 98
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 101
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 119,
                      "end": 121
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 115,
                          "end": 118
                        }
                      }
                    },
                    "span": {
                      "start": 115,
                      "end": 118
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 107,
                "end": 121
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 124
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 124
  }
}

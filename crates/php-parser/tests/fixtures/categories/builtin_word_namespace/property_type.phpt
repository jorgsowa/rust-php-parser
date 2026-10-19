===source===
<?php
class A { public int\X $p; public ?string\Y $q = null; }
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
                    "name": "p",
                    "span": {
                      "start": 29,
                      "end": 31
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int",
                          "X"
                        ],
                        "kind": "Qualified",
                        "span": {
                          "start": 23,
                          "end": 28
                        }
                      }
                    },
                    "span": {
                      "start": 23,
                      "end": 28
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 31
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 50,
                      "end": 52
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string",
                              "Y"
                            ],
                            "kind": "Qualified",
                            "span": {
                              "start": 41,
                              "end": 49
                            }
                          }
                        },
                        "span": {
                          "start": 41,
                          "end": 49
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 49
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 55,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}

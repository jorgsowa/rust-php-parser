===source===
<?php

class A {
    public string $a;
    protected static D $b;
    private ?float $c;
    readonly static public ?int $d;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                  "name": "a",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 28,
                          "end": 34,
                          "start_line": 4,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 28,
                      "end": 34,
                      "start_line": 4,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 37,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "b",
                  "visibility": "Protected",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "D"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 60,
                          "end": 62,
                          "start_line": 5,
                          "start_col": 21
                        }
                      }
                    },
                    "span": {
                      "start": 60,
                      "end": 62,
                      "start_line": 5,
                      "start_col": 21
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 64,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "c",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 79,
                              "end": 84,
                              "start_line": 6,
                              "start_col": 13
                            }
                          }
                        },
                        "span": {
                          "start": 79,
                          "end": 84,
                          "start_line": 6,
                          "start_col": 13
                        }
                      }
                    },
                    "span": {
                      "start": 78,
                      "end": 84,
                      "start_line": 6,
                      "start_col": 12
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 70,
                "end": 87,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "d",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 117,
                              "end": 120,
                              "start_line": 7,
                              "start_col": 28
                            }
                          }
                        },
                        "span": {
                          "start": 117,
                          "end": 120,
                          "start_line": 7,
                          "start_col": 28
                        }
                      }
                    },
                    "span": {
                      "start": 116,
                      "end": 120,
                      "start_line": 7,
                      "start_col": 27
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 93,
                "end": 123,
                "start_line": 7,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 126,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 126,
    "start_line": 1,
    "start_col": 0
  }
}

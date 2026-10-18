===source===
<?php class A { #[Attr] public private(set) ?int $a = 1, $b; }
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
                      "start": 49,
                      "end": 51
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
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
                              "start": 45,
                              "end": 48
                            }
                          }
                        },
                        "span": {
                          "start": 45,
                          "end": 48
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 48
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 54,
                      "end": 55
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attr"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 18,
                          "end": 22
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 18,
                        "end": 22
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 55
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 57,
                      "end": 59
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
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
                              "start": 45,
                              "end": 48
                            }
                          }
                        },
                        "span": {
                          "start": 45,
                          "end": 48
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 48
                    }
                  },
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attr"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 18,
                          "end": 22
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 18,
                        "end": 22
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
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

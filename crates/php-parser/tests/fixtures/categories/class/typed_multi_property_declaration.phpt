===source===
<?php class A { #[Attr] public private(set) ?int $a = 1, $b; }
===errors <=7.4===
missing closing '}'
===errors 8.0-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 1
===php_error 8.0-8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 1
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
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 49,
                      "end": 51
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private"
                  },
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
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private"
                  },
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

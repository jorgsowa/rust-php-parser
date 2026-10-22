===source===
<?php
class A extends B\__halt_compiler implements \__halt_compiler\I {}
function f(\__halt_compiler $a, X\__halt_compiler|null $b): \__halt_compiler\T {}
try {} catch (A\__halt_compiler $e) {}
echo 1;
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '__halt_compiler' (T_HALT_COMPILER), expecting identifier (T_STRING) in Standard input code on line 2
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
          "extends": {
            "parts": [
              "B",
              "__halt_compiler"
            ],
            "kind": "Qualified",
            "span": {
              "start": 22,
              "end": 39
            }
          },
          "implements": [
            {
              "parts": [
                "__halt_compiler",
                "I"
              ],
              "kind": "FullyQualified",
              "span": {
                "start": 51,
                "end": 69
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 72
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 82,
              "end": 83
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 101,
                  "end": 103
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "__halt_compiler"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 84,
                      "end": 100
                    }
                  }
                },
                "span": {
                  "start": 84,
                  "end": 100
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 84,
                "end": 103
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 128,
                  "end": 130
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "X",
                            "__halt_compiler"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 105,
                            "end": 122
                          }
                        }
                      },
                      "span": {
                        "start": 105,
                        "end": 122
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
                            "start": 123,
                            "end": 127
                          }
                        }
                      },
                      "span": {
                        "start": 123,
                        "end": 127
                      }
                    }
                  ]
                },
                "span": {
                  "start": 105,
                  "end": 127
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 105,
                "end": 130
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "__halt_compiler",
                  "T"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 133,
                  "end": 151
                }
              }
            },
            "span": {
              "start": 133,
              "end": 151
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 73,
        "end": 154
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "A",
                    "__halt_compiler"
                  ],
                  "kind": "Qualified",
                  "span": {
                    "start": 169,
                    "end": 186
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 187,
                  "end": 189
                }
              },
              "body": [],
              "span": {
                "start": 168,
                "end": 193
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 155,
        "end": 193
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 199,
              "end": 200
            }
          }
        ]
      },
      "span": {
        "start": 194,
        "end": 201
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 201
  }
}

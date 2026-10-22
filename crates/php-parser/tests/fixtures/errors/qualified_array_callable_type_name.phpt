===source===
<?php
function a(Foo\array $x): Foo\callable {}
function b(\Foo\array $x, namespace\array $y, namespace\callable $z) {}
function c(\array $x) {}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===errors >=8.5===
Cannot use "Foo\array" as a type name as it is reserved
Cannot use "Foo\callable" as a type name as it is reserved
Cannot use "Foo\array" as a type name as it is reserved
Cannot use "array" as a type name as it is reserved
Cannot use "callable" as a type name as it is reserved
Cannot use "array" as a type name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'array' (T_ARRAY), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use "Foo\callable" as a type name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 27,
                  "end": 29
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo",
                      "array"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 17,
                      "end": 26
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 26
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 29
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "Foo",
                  "callable"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 32,
                  "end": 44
                }
              }
            },
            "span": {
              "start": 32,
              "end": 44
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 57,
              "end": 58
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 70,
                  "end": 72
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo",
                      "array"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 59,
                      "end": 69
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 69
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 59,
                "end": 72
              }
            },
            {
              "name": {
                "name": "y",
                "span": {
                  "start": 90,
                  "end": 92
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 74,
                      "end": 89
                    }
                  }
                },
                "span": {
                  "start": 74,
                  "end": 89
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 74,
                "end": 92
              }
            },
            {
              "name": {
                "name": "z",
                "span": {
                  "start": 113,
                  "end": 115
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "callable"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 94,
                      "end": 112
                    }
                  }
                },
                "span": {
                  "start": 94,
                  "end": 112
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 94,
                "end": 115
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 48,
        "end": 119
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 129,
              "end": 130
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 138,
                  "end": 140
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 131,
                      "end": 137
                    }
                  }
                },
                "span": {
                  "start": 131,
                  "end": 137
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 131,
                "end": 140
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 120,
        "end": 144
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 144
  }
}

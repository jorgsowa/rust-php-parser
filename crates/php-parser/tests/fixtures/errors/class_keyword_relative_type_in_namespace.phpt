===source===
<?php
namespace N;
function f(): ?namespace\self {}
function g(namespace\array $a, Foo\int $b, \Foo\Array $c) {}
===errors <=8.4===
Cannot use "N\Foo\int" as a type name as it is reserved
Cannot use "self" when no class scope is active
===errors >=8.5===
Cannot use "N\array" as a type name as it is reserved
Cannot use "N\Foo\int" as a type name as it is reserved
Cannot use "Foo\Array" as a type name as it is reserved
Cannot use "self" when no class scope is active
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'array' (T_ARRAY), expecting identifier (T_STRING) in Standard input code on line 4
===php_error >=8.0===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 28,
              "end": 29
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "self"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 34,
                      "end": 48
                    }
                  }
                },
                "span": {
                  "start": 34,
                  "end": 48
                }
              }
            },
            "span": {
              "start": 33,
              "end": 48
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 51
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 61,
              "end": 62
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 79,
                  "end": 81
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
                      "start": 63,
                      "end": 78
                    }
                  }
                },
                "span": {
                  "start": 63,
                  "end": 78
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 63,
                "end": 81
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 91,
                  "end": 93
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo",
                      "int"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 83,
                      "end": 90
                    }
                  }
                },
                "span": {
                  "start": 83,
                  "end": 90
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 83,
                "end": 93
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 106,
                  "end": 108
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo",
                      "Array"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 95,
                      "end": 105
                    }
                  }
                },
                "span": {
                  "start": 95,
                  "end": 105
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 95,
                "end": 108
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
        "start": 52,
        "end": 112
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112
  }
}

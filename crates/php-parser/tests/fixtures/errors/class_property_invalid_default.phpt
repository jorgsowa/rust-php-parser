===source===
<?php
class Foo {
    public int $x = 1 +;
    public string $name = "valid";
}
===errors===
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                      "start": 33,
                      "end": 35
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 29,
                          "end": 32
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 32
                    }
                  },
                  "default": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 38,
                            "end": 39
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": "Error",
                          "span": {
                            "start": 41,
                            "end": 41
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 41
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "name",
                    "span": {
                      "start": 61,
                      "end": 66
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 54,
                          "end": 60
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 60
                    }
                  },
                  "default": {
                    "kind": {
                      "String": "valid"
                    },
                    "span": {
                      "start": 69,
                      "end": 76
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 76
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 79
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79
  }
}

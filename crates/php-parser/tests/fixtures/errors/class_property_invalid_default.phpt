===source===
<?php
class Foo {
    public int $x = 1 +;
    public string $name = "valid";
}
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "x",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                            "end": 42
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 42
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
                  "name": "name",
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
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 3

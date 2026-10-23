===source===
<?php class Foo { public function } class Bar { public int $x = 1; }
===errors===
expected method name, found '}'
expected '(', found '}'
expected variable, found '}'
expected ')', found '}'
expected ';', found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}" in Standard input code on line 1
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
                "Method": {
                  "name": null,
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": null,
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 33,
                        "end": 33
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 33
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Bar",
            "span": {
              "start": 42,
              "end": 45
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
                      "start": 59,
                      "end": 61
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
                          "start": 55,
                          "end": 58
                        }
                      }
                    },
                    "span": {
                      "start": 55,
                      "end": 58
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 48,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 36,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}

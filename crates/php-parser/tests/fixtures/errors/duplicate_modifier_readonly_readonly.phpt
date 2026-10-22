===source===
<?php class A { readonly readonly $x; }
===errors <=8.0===
'readonly properties' requires PHP 8.1 or higher
===errors >=8.1===
duplicate modifier 'readonly'
readonly property must have type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'readonly' (T_STRING), expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly", expecting "function" or "const" in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  Multiple readonly modifiers are not allowed in Standard input code on line 1
===ast <=8.0===
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
                    "name": "x",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "readonly"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 25,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 25,
                      "end": 33
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 36
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
===ast >=8.1===
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
                    "name": "x",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "is_readonly": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 36
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}

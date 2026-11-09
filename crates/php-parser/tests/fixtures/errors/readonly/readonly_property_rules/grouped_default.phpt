===source===
<?php
class A {
    public readonly int $b, $c = 2;
}
===errors <=8.0===
'readonly properties' requires PHP 8.1 or higher
Readonly property A::$c cannot have default value
===errors 8.1-8.5===
Readonly property A::$c cannot have default value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'int' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 3
===php_error 8.1-8.5===
PHP Fatal error:  Readonly property A::$c cannot have default value in Standard input code on line 3
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
                    "name": "b",
                    "span": {
                      "start": 40,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 39
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 42
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 44,
                      "end": 46
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 39
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 49,
                      "end": 50
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}

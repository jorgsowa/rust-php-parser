===source===
<?php
readonly class B {
    public array $d = [1];
}
===errors <=8.1===
'readonly class' requires PHP 8.2 or higher
Readonly property B::$d cannot have default value
===errors 8.2-8.5===
Readonly property B::$d cannot have default value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===php_error 8.2-8.5===
PHP Fatal error:  Readonly property B::$d cannot have default value in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 42,
                      "end": 44
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 41
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 41
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 48,
                                "end": 49
                              }
                            }
                          },
                          "span": {
                            "start": 48,
                            "end": 49
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 47,
                      "end": 50
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}

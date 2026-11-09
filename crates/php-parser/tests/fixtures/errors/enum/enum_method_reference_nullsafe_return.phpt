===source===
<?php
enum E {
    public function &g($a) { return $a?->b; }
}
===errors <=7.4===
'enums' requires PHP 8.1 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
Cannot take reference of a nullsafe chain
===errors 8.0===
'enums' requires PHP 8.1 or higher
Cannot take reference of a nullsafe chain
===errors >=8.1===
Cannot take reference of a nullsafe chain
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot take reference of a nullsafe chain in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": true,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 38,
                          "end": 40
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 38,
                        "end": 40
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "NullsafePropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 51,
                                  "end": 53
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 56,
                                  "end": 57
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 51,
                            "end": 57
                          }
                        }
                      },
                      "span": {
                        "start": 44,
                        "end": 58
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 60
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

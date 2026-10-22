===source===
<?php class Foo { public function __construct(public readonly int $x, private string $y = 'default') {} }
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
'constructor property promotion' requires PHP 8.0 or higher
===errors 8.0===
'readonly parameters' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 1
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
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 34,
                      "end": 45
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 66,
                          "end": 68
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 62,
                              "end": 65
                            }
                          }
                        },
                        "span": {
                          "start": 62,
                          "end": 65
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 68
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 85,
                          "end": 87
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 78,
                              "end": 84
                            }
                          }
                        },
                        "span": {
                          "start": 78,
                          "end": 84
                        }
                      },
                      "default": {
                        "kind": {
                          "String": "default"
                        },
                        "span": {
                          "start": 90,
                          "end": 99
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 70,
                        "end": 99
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 103
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 105
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 105
  }
}

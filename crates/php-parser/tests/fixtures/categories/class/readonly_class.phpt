===source===
<?php readonly class Point { public function __construct(public int $x, public int $y) {} }
===errors <=7.4===
'readonly class' requires PHP 8.2 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
===errors 8.0-8.1===
'readonly class' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 1
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Point",
            "span": {
              "start": 21,
              "end": 26
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 45,
                      "end": 56
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
                          "start": 68,
                          "end": 70
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
                              "start": 64,
                              "end": 67
                            }
                          }
                        },
                        "span": {
                          "start": 64,
                          "end": 67
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 57,
                        "end": 70
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 83,
                          "end": 85
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
                              "start": 79,
                              "end": 82
                            }
                          }
                        },
                        "span": {
                          "start": 79,
                          "end": 82
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 72,
                        "end": 85
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 89
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}

===source===
<?php function die(string|int $status = 0): never {}
===errors <=7.4===
cannot use 'die' as function name; it is reserved
'union types' requires PHP 8.0 or higher
===errors >=8.0===
cannot use 'die' as function name; it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'die' (T_EXIT), expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "exit", expecting "(" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "die",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "status",
                "span": {
                  "start": 30,
                  "end": 37
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 25
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 26,
                            "end": 29
                          }
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 29
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 29
                }
              },
              "default": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 40,
                  "end": 41
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 41
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 44,
                  "end": 49
                }
              }
            },
            "span": {
              "start": 44,
              "end": 49
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}

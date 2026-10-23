===source===
<?php $f = fn(readonly string $x) => $x;
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
Cannot declare promoted property outside a constructor
===errors 8.0===
'readonly parameters' requires PHP 8.1 or higher
Cannot declare promoted property outside a constructor
===errors >=8.1===
Cannot declare promoted property outside a constructor
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'string' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "string", expecting variable in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  Cannot declare promoted property outside a constructor in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 30,
                            "end": 32
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
                                "start": 23,
                                "end": 29
                              }
                            }
                          },
                          "span": {
                            "start": 23,
                            "end": 29
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "modifiers": {
                          "is_readonly": true
                        },
                        "attributes": [],
                        "span": {
                          "start": 14,
                          "end": 32
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}

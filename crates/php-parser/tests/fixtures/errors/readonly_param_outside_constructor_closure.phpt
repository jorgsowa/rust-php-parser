===source===
<?php $f = function(readonly string $x) {};
===errors >=8.1===
Cannot declare promoted property outside a constructor
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "string", expecting variable in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  Cannot declare promoted property outside a constructor in Standard input code on line 1
===ast >=8.1===
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
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 36,
                            "end": 38
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
                                "start": 29,
                                "end": 35
                              }
                            }
                          },
                          "span": {
                            "start": 29,
                            "end": 35
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
                          "start": 20,
                          "end": 38
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 42
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}

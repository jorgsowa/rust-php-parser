===source===
<?php class Foo { function bar(public readonly string $x) {} }
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
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "string", expecting variable in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  Cannot declare promoted property outside a constructor in Standard input code on line 1
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
                    "name": "bar",
                    "span": {
                      "start": 27,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 54,
                          "end": 56
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
                              "start": 47,
                              "end": 53
                            }
                          }
                        },
                        "span": {
                          "start": 47,
                          "end": 53
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
                        "start": 31,
                        "end": 56
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

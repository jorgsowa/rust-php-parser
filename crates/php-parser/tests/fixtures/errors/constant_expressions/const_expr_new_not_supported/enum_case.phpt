===source===
<?php
enum E: int {
    case A = new Foo;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
New expressions are not supported in this context
===errors >=8.1===
New expressions are not supported in this context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Enum case value must be compile-time evaluatable in Standard input code on line 3
===php_error >=8.2===
PHP Fatal error:  New expressions are not supported in this context in Standard input code on line 3
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
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 14,
              "end": 17
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 37,
                                "end": 40
                              }
                            }
                          },
                          "span": {
                            "start": 37,
                            "end": 40
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 41
              }
            }
          ],
          "attributes": []
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

===source===
<?php
enum E: int {
    const int A = 'a';
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'typed class constants' requires PHP 8.3 or higher
Cannot use string as value for class constant E::A of type int
===errors 8.1-8.2===
'typed class constants' requires PHP 8.3 or higher
Cannot use string as value for class constant E::A of type int
===errors >=8.3===
Cannot use string as value for class constant E::A of type int
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected identifier "A", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use string as value for class constant E::A of type int in Standard input code on line 3
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
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 34,
                      "end": 35
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
                          "start": 30,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 33
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 38,
                      "end": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}

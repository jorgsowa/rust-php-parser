===source===
<?php
enum E {
    const callable F = 1;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'typed class constants' requires PHP 8.3 or higher
Class constant E::F cannot have type callable
===errors 8.1-8.2===
'typed class constants' requires PHP 8.3 or higher
Class constant E::F cannot have type callable
===errors >=8.3===
Class constant E::F cannot have type callable
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected identifier "F", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Class constant E::F cannot have type callable in Standard input code on line 3
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
                "ClassConst": {
                  "name": {
                    "name": "F",
                    "span": {
                      "start": 34,
                      "end": 35
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "callable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 25,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 25,
                      "end": 33
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 38,
                      "end": 39
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 40
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}

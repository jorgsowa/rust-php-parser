===source===
<?php
enum E: int {
    const B = (object) [];
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'casts in constant expressions' requires PHP 8.5 or higher
===errors 8.1-8.4===
'casts in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Object casts are not supported in this context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Object casts are not supported in this context in Standard input code on line 3
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
                    "name": "B",
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "value": {
                    "kind": {
                      "Cast": [
                        "Object",
                        {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 43,
                            "end": 45
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 34,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}

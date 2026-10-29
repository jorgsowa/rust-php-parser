===source===
<?php
enum Direction {
    case North = 1;
    case South;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Case North of non-backed enum Direction must not have a value
===errors >=8.1===
Case North of non-backed enum Direction must not have a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Direction' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Direction" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Case North of non-backed enum Direction must not have a value, try adding ": int" to the enum declaration in Standard input code on line 3
===php_error >=8.2===
PHP Fatal error:  Case North of non-backed enum Direction must not have a value in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Direction",
            "span": {
              "start": 11,
              "end": 20
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "North",
                    "span": {
                      "start": 32,
                      "end": 37
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 42
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "South",
                    "span": {
                      "start": 52,
                      "end": 57
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}

===source===
<?php
enum E: string {
    case A = "x";
    case B = 'x';
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===errors 8.1===
Duplicate value in enum E for cases A and B
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Duplicate value in enum E for cases A and B in Standard input code on line 4
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
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 14,
              "end": 20
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
                      "start": 32,
                      "end": 33
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "x"
                    },
                    "span": {
                      "start": 36,
                      "end": 39
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 40
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 50,
                      "end": 51
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "x"
                    },
                    "span": {
                      "start": 54,
                      "end": 57
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 45,
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

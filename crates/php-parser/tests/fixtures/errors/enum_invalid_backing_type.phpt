===source===
<?php
enum Suit: bool {
    case Hearts = true;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Enum backing type must be int or string, bool given
===errors >=8.1===
Enum backing type must be int or string, bool given
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Suit' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Suit" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Enum backing type must be int or string, bool given in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Suit",
            "span": {
              "start": 11,
              "end": 15
            }
          },
          "scalar_type": {
            "parts": [
              "bool"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 17,
              "end": 21
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Hearts",
                    "span": {
                      "start": 33,
                      "end": 39
                    }
                  },
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 42,
                      "end": 46
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 28,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}

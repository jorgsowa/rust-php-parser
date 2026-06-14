===config===
min_php=8.1
===source===
<?php
enum Suit: bool {
    case Hearts = true;
}
===errors===
Enum backing type must be int or string
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Suit",
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
                  "name": "Hearts",
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
===php_error===
PHP Fatal error:  Enum backing type must be int or string, bool given in Standard input code on line 2

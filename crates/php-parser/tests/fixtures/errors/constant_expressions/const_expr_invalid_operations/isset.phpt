===source===
<?php
const H = isset(B);
===errors===
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "H",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Isset": [
                  {
                    "kind": {
                      "Name": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 23
                        }
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 23
                    }
                  }
                ]
              },
              "span": {
                "start": 16,
                "end": 24
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 24
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}

===source===
<?php
const G = @B;
===errors===
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
              "name": "G",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "ErrorSuppress": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 18
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 18
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 18
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}

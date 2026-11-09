===source===
<?php
const B = f();
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
              "name": "B",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "f"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 16,
                          "end": 17
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 16,
                "end": 19
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 19
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}

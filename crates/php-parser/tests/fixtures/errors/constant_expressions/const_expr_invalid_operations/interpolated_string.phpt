===source===
<?php
const E = "a$b";
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
              "name": "E",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "InterpolatedString": [
                  {
                    "Literal": "a"
                  },
                  {
                    "Expr": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    }
                  }
                ]
              },
              "span": {
                "start": 16,
                "end": 21
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 21
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}

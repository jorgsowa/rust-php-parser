===source===
<?php
const F = 1 instanceof B;
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
              "name": "F",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  },
                  "op": "Instanceof",
                  "right": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 29,
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 30
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 30
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}

===source===
<?php
const A = FOO && $x;
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
              "name": "A",
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
                      "Name": {
                        "parts": [
                          "FOO"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 16,
                          "end": 19
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 19
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 23,
                      "end": 25
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 25
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}

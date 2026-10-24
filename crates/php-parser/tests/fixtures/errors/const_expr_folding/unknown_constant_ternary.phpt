===source===
<?php
const A = FOO ? 1 : $x;
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
                "Ternary": {
                  "condition": {
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
                  "then_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 22,
                      "end": 23
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 26,
                      "end": 28
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 28
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 28
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}

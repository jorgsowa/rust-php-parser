===source===
<?php
const A = -0.0 || $x;
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
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Float": 0.0
                          },
                          "span": {
                            "start": 17,
                            "end": 20
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "op": "BooleanOr",
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 24,
                      "end": 26
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 26
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 26
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}

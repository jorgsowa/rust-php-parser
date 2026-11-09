===source===
<?php
const A = !1.5 && $a;
===errors >=8.5===
Constant expression contains invalid operations
===php_error >=8.5===
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
                        "op": "BooleanNot",
                        "operand": {
                          "kind": {
                            "Float": 1.5
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
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "a"
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

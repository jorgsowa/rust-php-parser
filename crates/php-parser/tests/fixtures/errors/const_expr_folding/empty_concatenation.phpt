===source===
<?php
const A = '' . '' ?: $x;
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
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": ""
                          },
                          "span": {
                            "start": 16,
                            "end": 18
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "String": ""
                          },
                          "span": {
                            "start": 21,
                            "end": 23
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 23
                    }
                  },
                  "then_expr": null,
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 29
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}

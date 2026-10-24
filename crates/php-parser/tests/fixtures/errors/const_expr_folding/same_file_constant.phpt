===source===
<?php
const FOO = 0;
const A = FOO && $x;
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "FOO",
              "span": {
                "start": 12,
                "end": 15
              }
            },
            "value": {
              "kind": {
                "Int": 0
              },
              "span": {
                "start": 18,
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
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 27,
                "end": 28
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
                          "start": 31,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 34
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 38,
                      "end": 40
                    }
                  }
                }
              },
              "span": {
                "start": 31,
                "end": 40
              }
            },
            "attributes": [],
            "span": {
              "start": 27,
              "end": 40
            }
          }
        ]
      },
      "span": {
        "start": 21,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}

===source===
<?php
namespace N;
const A = PHP_INT_MAX ?? $x;
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 25,
                "end": 26
              }
            },
            "value": {
              "kind": {
                "NullCoalesce": {
                  "left": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "PHP_INT_MAX"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 29,
                          "end": 40
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 40
                    }
                  },
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 44,
                      "end": 46
                    }
                  }
                }
              },
              "span": {
                "start": 29,
                "end": 46
              }
            },
            "attributes": [],
            "span": {
              "start": 25,
              "end": 46
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}

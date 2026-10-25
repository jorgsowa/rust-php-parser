===source===
<?php
function f(): int { declare(ticks=1): return; enddeclare; }
===errors===
A function with return type must return a value
===php_error===
PHP Fatal error:  A function with return type must return a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Declare": {
                  "directives": [
                    [
                      "ticks",
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 40,
                          "end": 41
                        }
                      }
                    ]
                  ],
                  "body": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "Return": null
                          },
                          "span": {
                            "start": 44,
                            "end": 51
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 42,
                      "end": 51
                    }
                  },
                  "uses_alternative": true
                }
              },
              "span": {
                "start": 26,
                "end": 63
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "int"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 23
                }
              }
            },
            "span": {
              "start": 20,
              "end": 23
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}

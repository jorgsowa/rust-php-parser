===source===
<?php
function f(): int { declare(ticks=1) { return; } }
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
                            "start": 45,
                            "end": 52
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 43,
                      "end": 54
                    }
                  }
                }
              },
              "span": {
                "start": 26,
                "end": 54
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
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}

===source===
<?php
function f(): void { declare(ticks=1) return 1; }
===errors===
A void function must not return a value
===php_error===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
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
                          "start": 41,
                          "end": 42
                        }
                      }
                    ]
                  ],
                  "body": {
                    "kind": {
                      "Return": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 51,
                          "end": 52
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 53
                    }
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 53
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 24
                }
              }
            },
            "span": {
              "start": 20,
              "end": 24
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}

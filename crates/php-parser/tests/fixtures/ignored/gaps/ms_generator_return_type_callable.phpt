===source===
<?php
function g(): callable { yield 1; }
===errors >=8.5===
Generator return type must be a supertype of Generator, callable given
===php_error===
PHP Fatal error:  Generator return type must be a supertype of Generator, callable given in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 37,
                          "end": 38
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 31,
                    "end": 38
                  }
                }
              },
              "span": {
                "start": 31,
                "end": 39
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "callable"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 28
                }
              }
            },
            "span": {
              "start": 20,
              "end": 28
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}

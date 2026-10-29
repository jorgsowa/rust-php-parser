===source===
<?php
function g(): int { yield 1; }
===errors <=7.4===
Generators may only declare a return type of Generator, Iterator, Traversable, or iterable, int is not permitted
===errors >=8.0===
Generator return type must be a supertype of Generator, int given
===php_error <=7.4===
PHP Fatal error:  Generators may only declare a return type of Generator, Iterator, Traversable, or iterable, int is not permitted in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Generator return type must be a supertype of Generator, int given in Standard input code on line 2
===ast===
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
                          "start": 32,
                          "end": 33
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 33
                  }
                }
              },
              "span": {
                "start": 26,
                "end": 34
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
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}

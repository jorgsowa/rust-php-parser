===source===
<?php
function g(): void { yield 1; }
===errors===
Generator return type must be a supertype of Generator, void given
===php_error <=7.4===
PHP Fatal error:  Generators may only declare a return type of Generator, Iterator, Traversable, or iterable, void is not permitted in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Generator return type must be a supertype of Generator, void given in Standard input code on line 2
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
                          "start": 33,
                          "end": 34
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 34
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 35
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
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}

===source===
<?php
$f = fn(): int => yield 1;
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
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 17,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 20
                      }
                    },
                    "body": {
                      "kind": {
                        "Yield": {
                          "key": null,
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 30,
                              "end": 31
                            }
                          },
                          "is_from": false
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 31
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}

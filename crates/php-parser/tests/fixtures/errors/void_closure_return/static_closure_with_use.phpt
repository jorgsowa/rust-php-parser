===source===
<?php
$f = static function () use ($a): void { return $a; };
===errors >=8.1===
A void function must not return a value
===php_error===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
===ast >=8.1===
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
                  "Closure": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 35,
                            "end": 37
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 35,
                          "end": 37
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
                            "start": 40,
                            "end": 44
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 44
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 54,
                              "end": 56
                            }
                          }
                        },
                        "span": {
                          "start": 47,
                          "end": 57
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 59
          }
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}

===config===
min_php=8.1
===source===
<?php
$f = function(): void { return 1; };
===errors===
A void function must not return a value
===php_error===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
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
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "void"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 27
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 37,
                              "end": 38
                            }
                          }
                        },
                        "span": {
                          "start": 30,
                          "end": 39
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 41
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 41
          }
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}

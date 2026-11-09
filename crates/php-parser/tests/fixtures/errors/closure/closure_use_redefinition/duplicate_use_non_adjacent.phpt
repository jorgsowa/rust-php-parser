===source===
<?php
$c = function () use ($x, $y, $x) {};
===errors===
Cannot use variable $x twice
===php_error===
PHP Fatal error:  Cannot use variable $x twice in Standard input code on line 2
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
                  "Variable": "c"
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
                    "use_vars": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 28,
                            "end": 30
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 28,
                          "end": 30
                        }
                      },
                      {
                        "name": {
                          "name": "y",
                          "span": {
                            "start": 32,
                            "end": 34
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 32,
                          "end": 34
                        }
                      },
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 36,
                            "end": 38
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 36,
                          "end": 38
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 42
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}

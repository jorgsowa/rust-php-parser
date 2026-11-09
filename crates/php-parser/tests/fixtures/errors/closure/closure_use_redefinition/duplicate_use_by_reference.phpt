===source===
<?php
$b = function () use ($x, &$x) {};
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
                  "Variable": "b"
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
                          "name": "x",
                          "span": {
                            "start": 33,
                            "end": 35
                          }
                        },
                        "by_ref": true,
                        "span": {
                          "start": 32,
                          "end": 35
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
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}

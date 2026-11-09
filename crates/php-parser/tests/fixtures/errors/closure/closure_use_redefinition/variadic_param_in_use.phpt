===source===
<?php
$f = function (...$x) use ($x) {};
===errors===
Cannot use lexical variable $x as a parameter name
===php_error===
PHP Fatal error:  Cannot use lexical variable $x as a parameter name in Standard input code on line 2
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
                    "params": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 24,
                            "end": 26
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": true,
                        "attributes": [],
                        "span": {
                          "start": 21,
                          "end": 26
                        }
                      }
                    ],
                    "use_vars": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 33,
                            "end": 35
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 33,
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

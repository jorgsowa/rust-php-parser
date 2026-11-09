===source===
<?php
$d = function ($x) use ($x) {};
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
                  "Variable": "d"
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
                            "start": 21,
                            "end": 23
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 21,
                          "end": 23
                        }
                      }
                    ],
                    "use_vars": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 30,
                            "end": 32
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 30,
                          "end": 32
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
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36
          }
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

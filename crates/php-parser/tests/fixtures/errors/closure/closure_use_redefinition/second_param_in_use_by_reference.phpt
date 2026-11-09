===source===
<?php
$e = function ($x, $y) use (&$y) {};
===errors===
Cannot use lexical variable $y as a parameter name
===php_error===
PHP Fatal error:  Cannot use lexical variable $y as a parameter name in Standard input code on line 2
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
                  "Variable": "e"
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
                      },
                      {
                        "name": {
                          "name": "y",
                          "span": {
                            "start": 25,
                            "end": 27
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 25,
                          "end": 27
                        }
                      }
                    ],
                    "use_vars": [
                      {
                        "name": {
                          "name": "y",
                          "span": {
                            "start": 35,
                            "end": 37
                          }
                        },
                        "by_ref": true,
                        "span": {
                          "start": 34,
                          "end": 37
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

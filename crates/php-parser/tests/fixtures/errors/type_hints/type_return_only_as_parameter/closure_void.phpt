===source===
<?php
$c = function (void $c) {};
===errors===
void cannot be used as a parameter type
===php_error===
PHP Fatal error:  void cannot be used as a parameter type in Standard input code on line 2
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
                    "params": [
                      {
                        "name": {
                          "name": "c",
                          "span": {
                            "start": 26,
                            "end": 28
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 21,
                                "end": 25
                              }
                            }
                          },
                          "span": {
                            "start": 21,
                            "end": 25
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 21,
                          "end": 28
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}

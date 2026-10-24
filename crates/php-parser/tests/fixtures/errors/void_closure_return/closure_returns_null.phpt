===source===
<?php
$f = function(): void { return null; };
===errors===
A void function must not return a value (did you mean "return;" instead of "return null;"?)
===php_error===
PHP Fatal error:  A void function must not return a value (did you mean "return;" instead of "return null;"?) in Standard input code on line 2
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
                            "kind": "Null",
                            "span": {
                              "start": 37,
                              "end": 41
                            }
                          }
                        },
                        "span": {
                          "start": 30,
                          "end": 42
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 44
          }
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}

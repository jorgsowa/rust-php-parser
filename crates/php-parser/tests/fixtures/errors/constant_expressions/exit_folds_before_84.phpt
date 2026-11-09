===source===
<?php
exit or isset(1+1);
===errors >=8.4===
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===php_error >=8.4===
PHP Fatal error:  Cannot use isset() on the result of an expression (you can use "null !== expression" instead) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Exit": null
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 20,
                              "end": 21
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 22,
                              "end": 23
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  ]
                },
                "span": {
                  "start": 14,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}

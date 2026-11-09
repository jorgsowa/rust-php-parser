===source===
<?php
$x = [$GLOBALS[] => 1];
===errors===
Cannot use [] for reading
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "GLOBALS"
                              },
                              "span": {
                                "start": 12,
                                "end": 20
                              }
                            },
                            "index": null
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 22
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 26,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}

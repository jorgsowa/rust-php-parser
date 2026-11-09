===source===
<?php
$x = ['k' => &$GLOBALS[]];
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
                          "String": "k"
                        },
                        "span": {
                          "start": 12,
                          "end": 15
                        }
                      },
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "GLOBALS"
                                },
                                "span": {
                                  "start": 20,
                                  "end": 28
                                }
                              },
                              "index": null
                            }
                          },
                          "span": {
                            "start": 20,
                            "end": 30
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 30
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}

===source===
<?php
$x = [...$GLOBALS[]];
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
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "GLOBALS"
                                },
                                "span": {
                                  "start": 15,
                                  "end": 23
                                }
                              },
                              "index": null
                            }
                          },
                          "span": {
                            "start": 15,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 25
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}

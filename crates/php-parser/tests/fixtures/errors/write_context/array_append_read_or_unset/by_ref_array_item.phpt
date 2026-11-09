===source===
<?php
$x = [&$a[]];
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
                        "ByRef": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 13,
                                  "end": 15
                                }
                              },
                              "index": null
                            }
                          },
                          "span": {
                            "start": 13,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 17
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}

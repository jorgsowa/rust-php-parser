===source===
<?php
$x = 1 + ($GLOBALS)[];
===errors <=8.0===
Cannot use [] for reading
===errors >=8.1===
Cannot append to $GLOBALS
===php_error <=8.0===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Variable": "GLOBALS"
                                },
                                "span": {
                                  "start": 16,
                                  "end": 24
                                }
                              }
                            },
                            "span": {
                              "start": 15,
                              "end": 25
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 27
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}

===source===
<?php
$x = $GLOBALS[]->a ?? 1;
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
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Variable": "GLOBALS"
                                  },
                                  "span": {
                                    "start": 11,
                                    "end": 19
                                  }
                                },
                                "index": null
                              }
                            },
                            "span": {
                              "start": 11,
                              "end": 21
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "a"
                            },
                            "span": {
                              "start": 23,
                              "end": 24
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 24
                      }
                    },
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 28,
                        "end": 29
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}

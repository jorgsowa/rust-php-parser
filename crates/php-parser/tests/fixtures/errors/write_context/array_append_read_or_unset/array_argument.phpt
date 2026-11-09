===source===
<?php
f([$a[]]);
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
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 9,
                                        "end": 11
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 9,
                                  "end": 13
                                }
                              }
                            },
                            "span": {
                              "start": 9,
                              "end": 13
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 8,
                        "end": 14
                      }
                    }
                  },
                  "span": {
                    "start": 8,
                    "end": 14
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}

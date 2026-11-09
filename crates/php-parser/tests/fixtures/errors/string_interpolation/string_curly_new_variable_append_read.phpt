===source===
<?php echo "{$x(new $a[])}";
===errors===
Cannot use [] for reading
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "ArrayAccess": {
                                          "array": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 20,
                                              "end": 22
                                            }
                                          },
                                          "index": null
                                        }
                                      },
                                      "span": {
                                        "start": 20,
                                        "end": 24
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 16,
                                  "end": 24
                                }
                              }
                            },
                            "span": {
                              "start": 16,
                              "end": 24
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 25
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 27
            }
          }
        ]
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

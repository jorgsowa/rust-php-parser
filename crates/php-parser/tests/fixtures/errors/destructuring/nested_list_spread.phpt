===source===
<?php [$a, [...$b]] = $c;
===errors===
Spread operator is not supported in assignments
===php_error===
PHP Fatal error:  Spread operator is not supported in assignments in Standard input code on line 1
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Spread": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 15,
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
                      },
                      "span": {
                        "start": 11,
                        "end": 18
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 22,
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

===source===
<?php
[$a, [&$b]] = [1];
===errors===
Cannot assign reference to non referenceable value
===php_error <=8.0===
PHP Fatal error:  Cannot assign reference to non referencable value in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot assign reference to non referenceable value in Standard input code on line 2
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
                                  "ByRef": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 13,
                                      "end": 15
                                    }
                                  }
                                },
                                "span": {
                                  "start": 12,
                                  "end": 15
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 11,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 21,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 22
                      }
                    }
                  ]
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}

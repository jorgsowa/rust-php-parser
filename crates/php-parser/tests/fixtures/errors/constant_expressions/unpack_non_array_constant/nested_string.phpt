===source===
<?php
$a = [...[1], ...[...'a']];
===errors===
Only arrays and Traversables can be unpacked, string given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Only arrays and Traversables can be unpacked, string given in Standard input code on line 2
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
                  "Variable": "a"
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
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 16,
                                      "end": 17
                                    }
                                  }
                                },
                                "span": {
                                  "start": 16,
                                  "end": 17
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 15,
                            "end": 18
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 18
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Spread": {
                                    "kind": {
                                      "String": "a"
                                    },
                                    "span": {
                                      "start": 27,
                                      "end": 30
                                    }
                                  }
                                },
                                "span": {
                                  "start": 24,
                                  "end": 30
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 23,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 31
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}

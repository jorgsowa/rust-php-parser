===source===
<?php
[$b, [$c, ($this)]] = $a;
===errors===
Cannot re-assign $this
===php_error===
PHP Fatal error:  Cannot re-assign $this in Standard input code on line 2
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
                            "Variable": "b"
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
                                  "Value": {
                                    "kind": {
                                      "Variable": "c"
                                    },
                                    "span": {
                                      "start": 12,
                                      "end": 14
                                    }
                                  }
                                },
                                "span": {
                                  "start": 12,
                                  "end": 14
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Variable": "this"
                                        },
                                        "span": {
                                          "start": 17,
                                          "end": 22
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 16,
                                      "end": 23
                                    }
                                  }
                                },
                                "span": {
                                  "start": 16,
                                  "end": 23
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 11,
                            "end": 24
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 24
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 25
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 28,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}

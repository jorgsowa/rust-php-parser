===source===
<?php
$a = [...(false ? [1] : 2)];
===errors===
Only arrays and Traversables can be unpacked, int given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Only arrays and Traversables can be unpacked, int given in Standard input code on line 2
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
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Bool": false
                                    },
                                    "span": {
                                      "start": 16,
                                      "end": 21
                                    }
                                  },
                                  "then_expr": {
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
                                                "start": 25,
                                                "end": 26
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 25,
                                            "end": 26
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 24,
                                      "end": 27
                                    }
                                  },
                                  "else_expr": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 30,
                                      "end": 31
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 16,
                                "end": 31
                              }
                            }
                          },
                          "span": {
                            "start": 15,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 32
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}

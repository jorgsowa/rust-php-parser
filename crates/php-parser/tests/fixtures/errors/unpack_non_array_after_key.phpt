===source===
<?php
$a = [null => 1, ...2];
$b = [1.5 => 1, ...2];
===errors <=8.0===
Only arrays and Traversables can be unpacked
Only arrays and Traversables can be unpacked
===errors 8.1-8.3===
Only arrays and Traversables can be unpacked
===errors 8.4===
Only arrays and Traversables can be unpacked, int given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error 8.4===
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
                      "key": {
                        "kind": "Null",
                        "span": {
                          "start": 12,
                          "end": 16
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 20,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 21
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 26,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 30,
                  "end": 32
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "Float": 1.5
                        },
                        "span": {
                          "start": 36,
                          "end": 39
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 43,
                            "end": 44
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 44
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 49,
                            "end": 50
                          }
                        }
                      },
                      "span": {
                        "start": 46,
                        "end": 50
                      }
                    }
                  ]
                },
                "span": {
                  "start": 35,
                  "end": 51
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 51
          }
        }
      },
      "span": {
        "start": 30,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}

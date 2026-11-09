===source===
<?php
var_dump(list($a));
$x = list($a, $b);
===errors===
list() can only be used as an assignment or foreach target
list() can only be used as an assignment or foreach target
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting '=' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ")", expecting "=" in Standard input code on line 2
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
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
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
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 20,
                                  "end": 22
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 22
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 15,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 15,
                    "end": 23
                  }
                }
              ]
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
    },
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
                  "start": 26,
                  "end": 28
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
                            "Variable": "a"
                          },
                          "span": {
                            "start": 36,
                            "end": 38
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 38
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 40,
                            "end": 42
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 42
                      }
                    }
                  ]
                },
                "span": {
                  "start": 31,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 43
          }
        }
      },
      "span": {
        "start": 26,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}

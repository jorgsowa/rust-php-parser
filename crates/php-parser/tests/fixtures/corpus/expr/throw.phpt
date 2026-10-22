===source===
<?php
test(throw $x);
$a ?? throw new Exception;
===errors <=7.4===
'throw expressions' requires PHP 8.0 or higher
'throw expressions' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'throw' (T_THROW) in Standard input code on line 2
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
                      "test"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 10
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Throw": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 17,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 19
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "right": {
                "kind": {
                  "Throw": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Exception"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 38,
                                "end": 47
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 47
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 47
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 47
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 47
          }
        }
      },
      "span": {
        "start": 22,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}

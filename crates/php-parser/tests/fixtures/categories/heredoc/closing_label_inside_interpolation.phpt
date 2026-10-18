===source===
<?php
$b = <<<FOO
    Test ${
        FOO
    } {$a[
    FOO
    ]}
    FOO;
$c = <<<FOO
    x \${
    FOO;
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
                  "Variable": "b"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "FOO",
                    "parts": [
                      {
                        "Literal": "Test "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "VariableVariable": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "FOO"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 38,
                                    "end": 41
                                  }
                                }
                              },
                              "span": {
                                "start": 38,
                                "end": 41
                              }
                            }
                          },
                          "span": {
                            "start": 27,
                            "end": 47
                          }
                        }
                      },
                      {
                        "Literal": " "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 49,
                                  "end": 51
                                }
                              },
                              "index": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "FOO"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 57,
                                      "end": 60
                                    }
                                  }
                                },
                                "span": {
                                  "start": 57,
                                  "end": 60
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 49,
                            "end": 66
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 75
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 75
          }
        }
      },
      "span": {
        "start": 6,
        "end": 76
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 77,
                  "end": 79
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "FOO",
                    "parts": [
                      {
                        "Literal": "x ${"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 82,
                  "end": 106
                }
              }
            }
          },
          "span": {
            "start": 77,
            "end": 106
          }
        }
      },
      "span": {
        "start": 77,
        "end": 107
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 107
  }
}

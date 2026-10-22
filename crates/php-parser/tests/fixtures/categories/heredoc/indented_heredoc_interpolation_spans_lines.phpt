===source===
<?php
$x = <<<EOT
    a {$b
} c
    EOT;
$x = <<<EOT
    a ${b
}
    EOT;
$x = <<<EOT
    a {$b[<<<X
z
X]}
    EOT;
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
                  "Variable": "x"
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
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 25,
                            "end": 27
                          }
                        }
                      },
                      {
                        "Literal": " c"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
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
                  "start": 41,
                  "end": 43
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "VariableVariable": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "b"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 61,
                                    "end": 62
                                  }
                                }
                              },
                              "span": {
                                "start": 61,
                                "end": 62
                              }
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 64
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 46,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 72
          }
        }
      },
      "span": {
        "start": 41,
        "end": 73
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
                  "start": 74,
                  "end": 76
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 93,
                                  "end": 95
                                }
                              },
                              "index": {
                                "kind": {
                                  "Heredoc": {
                                    "label": "X",
                                    "parts": [
                                      {
                                        "Literal": "z"
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 96,
                                  "end": 104
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 93,
                            "end": 105
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 79,
                  "end": 114
                }
              }
            }
          },
          "span": {
            "start": 74,
            "end": 114
          }
        }
      },
      "span": {
        "start": 74,
        "end": 115
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115
  }
}

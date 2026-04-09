===source===
<?php
$$var = 1;
echo $$name;
$$$deep = 2;
${$expr} = 3;
${$a . $b} = 4;
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
                  "VariableVariable": {
                    "kind": {
                      "Variable": "var"
                    },
                    "span": {
                      "start": 7,
                      "end": 11,
                      "start_line": 2,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 14,
                  "end": 15,
                  "start_line": 2,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 15,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "VariableVariable": {
                "kind": {
                  "Variable": "name"
                },
                "span": {
                  "start": 23,
                  "end": 28,
                  "start_line": 3,
                  "start_col": 6
                }
              }
            },
            "span": {
              "start": 22,
              "end": 28,
              "start_line": 3,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 17,
        "end": 30,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Variable": "deep"
                        },
                        "span": {
                          "start": 32,
                          "end": 37,
                          "start_line": 4,
                          "start_col": 2
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 37,
                      "start_line": 4,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 37,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 40,
                  "end": 41,
                  "start_line": 4,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 41,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 30,
        "end": 43,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "expr"
                    },
                    "span": {
                      "start": 45,
                      "end": 50,
                      "start_line": 5,
                      "start_col": 2
                    }
                  }
                },
                "span": {
                  "start": 43,
                  "end": 50,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 54,
                  "end": 55,
                  "start_line": 5,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 55,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 43,
        "end": 57,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 59,
                            "end": 61,
                            "start_line": 6,
                            "start_col": 2
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 64,
                            "end": 66,
                            "start_line": 6,
                            "start_col": 7
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 66,
                      "start_line": 6,
                      "start_col": 2
                    }
                  }
                },
                "span": {
                  "start": 57,
                  "end": 66,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 70,
                  "end": 71,
                  "start_line": 6,
                  "start_col": 13
                }
              }
            }
          },
          "span": {
            "start": 57,
            "end": 71,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 57,
        "end": 72,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72,
    "start_line": 1,
    "start_col": 0
  }
}

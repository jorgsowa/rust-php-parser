===source===
<?php
$$var = 1;
$$$var = 2;
${$a . $b} = 3;
echo $$obj->prop;
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
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Variable": "var"
                        },
                        "span": {
                          "start": 19,
                          "end": 23,
                          "start_line": 3,
                          "start_col": 2
                        }
                      }
                    },
                    "span": {
                      "start": 18,
                      "end": 23,
                      "start_line": 3,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 23,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 26,
                  "end": 27,
                  "start_line": 3,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 27,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 17,
        "end": 29,
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
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 31,
                            "end": 33,
                            "start_line": 4,
                            "start_col": 2
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 36,
                            "end": 38,
                            "start_line": 4,
                            "start_col": 7
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 38,
                      "start_line": 4,
                      "start_col": 2
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 38,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 42,
                  "end": 43,
                  "start_line": 4,
                  "start_col": 13
                }
              }
            }
          },
          "span": {
            "start": 29,
            "end": 43,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 29,
        "end": 45,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "VariableVariable": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 51,
                        "end": 55,
                        "start_line": 5,
                        "start_col": 6
                      }
                    }
                  },
                  "span": {
                    "start": 50,
                    "end": 55,
                    "start_line": 5,
                    "start_col": 5
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "prop"
                  },
                  "span": {
                    "start": 57,
                    "end": 61,
                    "start_line": 5,
                    "start_col": 12
                  }
                }
              }
            },
            "span": {
              "start": 50,
              "end": 61,
              "start_line": 5,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 45,
        "end": 62,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php

list(&$v) = $x;
list('k' => &$v) = $x;
[&$v] = $x;
['k' => &$v] = $x;
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
                      "value": {
                        "kind": {
                          "Variable": "v"
                        },
                        "span": {
                          "start": 13,
                          "end": 15,
                          "start_line": 3,
                          "start_col": 6
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 12,
                        "end": 15,
                        "start_line": 3,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 7,
                  "end": 16,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 19,
                  "end": 21,
                  "start_line": 3,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 21,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 23,
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 28,
                          "end": 31,
                          "start_line": 4,
                          "start_col": 5
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "v"
                        },
                        "span": {
                          "start": 36,
                          "end": 38,
                          "start_line": 4,
                          "start_col": 13
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 28,
                        "end": 38,
                        "start_line": 4,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 23,
                  "end": 39,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 42,
                  "end": 44,
                  "start_line": 4,
                  "start_col": 19
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 44,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 23,
        "end": 46,
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "v"
                        },
                        "span": {
                          "start": 48,
                          "end": 50,
                          "start_line": 5,
                          "start_col": 2
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 47,
                        "end": 50,
                        "start_line": 5,
                        "start_col": 1
                      }
                    }
                  ]
                },
                "span": {
                  "start": 46,
                  "end": 51,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 54,
                  "end": 56,
                  "start_line": 5,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 46,
            "end": 56,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 46,
        "end": 58,
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 59,
                          "end": 62,
                          "start_line": 6,
                          "start_col": 1
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "v"
                        },
                        "span": {
                          "start": 67,
                          "end": 69,
                          "start_line": 6,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 59,
                        "end": 69,
                        "start_line": 6,
                        "start_col": 1
                      }
                    }
                  ]
                },
                "span": {
                  "start": 58,
                  "end": 70,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 73,
                  "end": 75,
                  "start_line": 6,
                  "start_col": 15
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 75,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 58,
        "end": 76,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76,
    "start_line": 1,
    "start_col": 0
  }
}

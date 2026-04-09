===source===
<?php
isset($a);
isset($a, $b, $c);

empty($a);
empty(foo());
empty(array(1, 2, 3));
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 12,
                  "end": 14,
                  "start_line": 2,
                  "start_col": 6
                }
              }
            ]
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
            "Isset": [
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 23,
                  "end": 25,
                  "start_line": 3,
                  "start_col": 6
                }
              },
              {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 27,
                  "end": 29,
                  "start_line": 3,
                  "start_col": 10
                }
              },
              {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 31,
                  "end": 33,
                  "start_line": 3,
                  "start_col": 14
                }
              }
            ]
          },
          "span": {
            "start": 17,
            "end": 34,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 17,
        "end": 37,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Empty": {
              "kind": {
                "Variable": "a"
              },
              "span": {
                "start": 43,
                "end": 45,
                "start_line": 5,
                "start_col": 6
              }
            }
          },
          "span": {
            "start": 37,
            "end": 46,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 37,
        "end": 48,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Empty": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 54,
                      "end": 57,
                      "start_line": 6,
                      "start_col": 6
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 54,
                "end": 59,
                "start_line": 6,
                "start_col": 6
              }
            }
          },
          "span": {
            "start": 48,
            "end": 60,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 48,
        "end": 62,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Empty": {
              "kind": {
                "Array": [
                  {
                    "key": null,
                    "value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 74,
                        "end": 75,
                        "start_line": 7,
                        "start_col": 12
                      }
                    },
                    "unpack": false,
                    "span": {
                      "start": 74,
                      "end": 75,
                      "start_line": 7,
                      "start_col": 12
                    }
                  },
                  {
                    "key": null,
                    "value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 77,
                        "end": 78,
                        "start_line": 7,
                        "start_col": 15
                      }
                    },
                    "unpack": false,
                    "span": {
                      "start": 77,
                      "end": 78,
                      "start_line": 7,
                      "start_col": 15
                    }
                  },
                  {
                    "key": null,
                    "value": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 80,
                        "end": 81,
                        "start_line": 7,
                        "start_col": 18
                      }
                    },
                    "unpack": false,
                    "span": {
                      "start": 80,
                      "end": 81,
                      "start_line": 7,
                      "start_col": 18
                    }
                  }
                ]
              },
              "span": {
                "start": 68,
                "end": 82,
                "start_line": 7,
                "start_col": 6
              }
            }
          },
          "span": {
            "start": 62,
            "end": 83,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 62,
        "end": 84,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 84,
    "start_line": 1,
    "start_col": 0
  }
}

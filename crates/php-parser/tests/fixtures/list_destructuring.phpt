===source===
<?php
list($a, $b, $c) = getValues();
list($x, , $z) = $array;
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
                          "Variable": "a"
                        },
                        "span": {
                          "start": 11,
                          "end": 13,
                          "start_line": 2,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 13,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 15,
                          "end": 17,
                          "start_line": 2,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 17,
                        "start_line": 2,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 19,
                          "end": 21,
                          "start_line": 2,
                          "start_col": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 19,
                        "end": 21,
                        "start_line": 2,
                        "start_col": 13
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 22,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "getValues"
                      },
                      "span": {
                        "start": 25,
                        "end": 34,
                        "start_line": 2,
                        "start_col": 19
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 25,
                  "end": 36,
                  "start_line": 2,
                  "start_col": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38,
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 43,
                          "end": 45,
                          "start_line": 3,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 43,
                        "end": 45,
                        "start_line": 3,
                        "start_col": 5
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 47,
                          "end": 48,
                          "start_line": 3,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 47,
                        "end": 48,
                        "start_line": 3,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "z"
                        },
                        "span": {
                          "start": 49,
                          "end": 51,
                          "start_line": 3,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 49,
                        "end": 51,
                        "start_line": 3,
                        "start_col": 11
                      }
                    }
                  ]
                },
                "span": {
                  "start": 38,
                  "end": 52,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "array"
                },
                "span": {
                  "start": 55,
                  "end": 61,
                  "start_line": 3,
                  "start_col": 17
                }
              }
            }
          },
          "span": {
            "start": 38,
            "end": 61,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 38,
        "end": 62,
        "start_line": 3,
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

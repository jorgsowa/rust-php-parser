===source===
<?php

new ('Foo' . $bar);
new ('Foo' . $bar)($arg);
$obj instanceof ('Foo' . $bar);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "Foo"
                          },
                          "span": {
                            "start": 12,
                            "end": 17,
                            "start_line": 3,
                            "start_col": 5
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Variable": "bar"
                          },
                          "span": {
                            "start": 20,
                            "end": 24,
                            "start_line": 3,
                            "start_col": 13
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 12,
                      "end": 24,
                      "start_line": 3,
                      "start_col": 5
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 25,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 25,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 27,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "Foo"
                          },
                          "span": {
                            "start": 32,
                            "end": 37,
                            "start_line": 4,
                            "start_col": 5
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Variable": "bar"
                          },
                          "span": {
                            "start": 40,
                            "end": 44,
                            "start_line": 4,
                            "start_col": 13
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 44,
                      "start_line": 4,
                      "start_col": 5
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 45,
                  "start_line": 4,
                  "start_col": 4
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "arg"
                    },
                    "span": {
                      "start": 46,
                      "end": 50,
                      "start_line": 4,
                      "start_col": 19
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 46,
                    "end": 50,
                    "start_line": 4,
                    "start_col": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 27,
            "end": 51,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 27,
        "end": 53,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 53,
                  "end": 57,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "Foo"
                          },
                          "span": {
                            "start": 70,
                            "end": 75,
                            "start_line": 5,
                            "start_col": 17
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Variable": "bar"
                          },
                          "span": {
                            "start": 78,
                            "end": 82,
                            "start_line": 5,
                            "start_col": 25
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 70,
                      "end": 82,
                      "start_line": 5,
                      "start_col": 17
                    }
                  }
                },
                "span": {
                  "start": 69,
                  "end": 83,
                  "start_line": 5,
                  "start_col": 16
                }
              }
            }
          },
          "span": {
            "start": 53,
            "end": 83,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 53,
        "end": 84,
        "start_line": 5,
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

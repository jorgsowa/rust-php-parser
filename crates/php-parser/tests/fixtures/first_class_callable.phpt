===source===
<?php
$fn = strlen(...);
$fn = $obj->method(...);
$fn = Foo::bar(...);
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Function": {
                        "kind": {
                          "Identifier": "strlen"
                        },
                        "span": {
                          "start": 12,
                          "end": 18,
                          "start_line": 2,
                          "start_col": 6
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 23,
                  "start_line": 2,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 25,
                  "end": 28,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Method": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 31,
                            "end": 35,
                            "start_line": 3,
                            "start_col": 6
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "method"
                          },
                          "span": {
                            "start": 37,
                            "end": 43,
                            "start_line": 3,
                            "start_col": 12
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 48,
                  "start_line": 3,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 48,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 50,
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 50,
                  "end": 53,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "StaticMethod": {
                        "class": {
                          "kind": {
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 56,
                            "end": 59,
                            "start_line": 4,
                            "start_col": 6
                          }
                        },
                        "method": "bar"
                      }
                    }
                  }
                },
                "span": {
                  "start": 56,
                  "end": 69,
                  "start_line": 4,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 69,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 50,
        "end": 70,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php
$x = 42;
$name = 'hello';
$pi = 3.14;
$flag = true;
$nothing = null;
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
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 42
                },
                "span": {
                  "start": 11,
                  "end": 13,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15,
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
                  "Variable": "name"
                },
                "span": {
                  "start": 15,
                  "end": 20,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "hello"
                },
                "span": {
                  "start": 23,
                  "end": 30,
                  "start_line": 3,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 15,
            "end": 30,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 15,
        "end": 32,
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
                  "Variable": "pi"
                },
                "span": {
                  "start": 32,
                  "end": 35,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Float": 3.14
                },
                "span": {
                  "start": 38,
                  "end": 42,
                  "start_line": 4,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 42,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 32,
        "end": 44,
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
                  "Variable": "flag"
                },
                "span": {
                  "start": 44,
                  "end": 49,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Bool": true
                },
                "span": {
                  "start": 52,
                  "end": 56,
                  "start_line": 5,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 44,
            "end": 56,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 44,
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
                  "Variable": "nothing"
                },
                "span": {
                  "start": 58,
                  "end": 66,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Null",
                "span": {
                  "start": 69,
                  "end": 73,
                  "start_line": 6,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 73,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 58,
        "end": 74,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74,
    "start_line": 1,
    "start_col": 0
  }
}

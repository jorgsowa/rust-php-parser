===source===
<?php -$x; !$y; ~$z; ++$a; --$b;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "Negate",
              "operand": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 7,
                  "end": 9,
                  "start_line": 1,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 9,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BooleanNot",
              "operand": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 12,
                  "end": 14,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 11,
            "end": 14,
            "start_line": 1,
            "start_col": 11
          }
        }
      },
      "span": {
        "start": 11,
        "end": 16,
        "start_line": 1,
        "start_col": 11
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BitwiseNot",
              "operand": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 17,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 17
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 19,
            "start_line": 1,
            "start_col": 16
          }
        }
      },
      "span": {
        "start": 16,
        "end": 21,
        "start_line": 1,
        "start_col": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreIncrement",
              "operand": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 23,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 23
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 25,
            "start_line": 1,
            "start_col": 21
          }
        }
      },
      "span": {
        "start": 21,
        "end": 27,
        "start_line": 1,
        "start_col": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreDecrement",
              "operand": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 29,
                  "end": 31,
                  "start_line": 1,
                  "start_col": 29
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 31,
            "start_line": 1,
            "start_col": 27
          }
        }
      },
      "span": {
        "start": 27,
        "end": 32,
        "start_line": 1,
        "start_col": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32,
    "start_line": 1,
    "start_col": 0
  }
}

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
                  "end": 9
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 9
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10
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
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 11,
            "end": 14
          }
        }
      },
      "span": {
        "start": 11,
        "end": 15
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
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 19
          }
        }
      },
      "span": {
        "start": 16,
        "end": 20
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
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 25
          }
        }
      },
      "span": {
        "start": 21,
        "end": 26
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
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 31
          }
        }
      },
      "span": {
        "start": 27,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}

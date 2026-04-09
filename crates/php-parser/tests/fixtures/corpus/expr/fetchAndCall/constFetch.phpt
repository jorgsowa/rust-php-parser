===source===
<?php

A;
A::B;
A::class;
$a::B;
$a::class;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "A"
          },
          "span": {
            "start": 7,
            "end": 8,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 10,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 10,
                  "end": 11,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "member": "B"
            }
          },
          "span": {
            "start": 10,
            "end": 14,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 10,
        "end": 16,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 16,
                  "end": 17,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "member": "class"
            }
          },
          "span": {
            "start": 16,
            "end": 24,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 16,
        "end": 26,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 26,
                  "end": 28,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "member": "B"
            }
          },
          "span": {
            "start": 26,
            "end": 31,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 26,
        "end": 33,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 33,
                  "end": 35,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "member": "class"
            }
          },
          "span": {
            "start": 33,
            "end": 42,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 33,
        "end": 43,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43,
    "start_line": 1,
    "start_col": 0
  }
}

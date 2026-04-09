===source===
<?php
(array)   $a;
(bool)    $a;
(boolean) $a;
(real)    $a;
(double)  $a;
(float)   $a;
(int)     $a;
(integer) $a;
(object)  $a;
(string)  $a;
(unset)   $a;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Array",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 16,
                  "end": 18,
                  "start_line": 2,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 18,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Bool",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 30,
                  "end": 32,
                  "start_line": 3,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 20,
            "end": 32,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 20,
        "end": 34,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Bool",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 44,
                  "end": 46,
                  "start_line": 4,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 34,
            "end": 46,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 34,
        "end": 48,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Float",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 58,
                  "end": 60,
                  "start_line": 5,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 48,
            "end": 60,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 48,
        "end": 62,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Float",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 72,
                  "end": 74,
                  "start_line": 6,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 62,
            "end": 74,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 62,
        "end": 76,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Float",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 86,
                  "end": 88,
                  "start_line": 7,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 76,
            "end": 88,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 76,
        "end": 90,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 100,
                  "end": 102,
                  "start_line": 8,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 90,
            "end": 102,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 90,
        "end": 104,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 114,
                  "end": 116,
                  "start_line": 9,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 104,
            "end": 116,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 104,
        "end": 118,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Object",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 128,
                  "end": 130,
                  "start_line": 10,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 118,
            "end": 130,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 118,
        "end": 132,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "String",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 142,
                  "end": 144,
                  "start_line": 11,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 132,
            "end": 144,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 132,
        "end": 146,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Unset",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 156,
                  "end": 158,
                  "start_line": 12,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 146,
            "end": 158,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 146,
        "end": 159,
        "start_line": 12,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 159,
    "start_line": 1,
    "start_col": 0
  }
}

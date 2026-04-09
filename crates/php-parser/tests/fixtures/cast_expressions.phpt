===source===
<?php (int)$x; (float)$y; (string)$z; (bool)$a; (array)$b; (object)$c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 11,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 13,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15,
        "start_line": 1,
        "start_col": 6
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
                  "Variable": "y"
                },
                "span": {
                  "start": 22,
                  "end": 24,
                  "start_line": 1,
                  "start_col": 22
                }
              }
            ]
          },
          "span": {
            "start": 15,
            "end": 24,
            "start_line": 1,
            "start_col": 15
          }
        }
      },
      "span": {
        "start": 15,
        "end": 26,
        "start_line": 1,
        "start_col": 15
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
                  "Variable": "z"
                },
                "span": {
                  "start": 34,
                  "end": 36,
                  "start_line": 1,
                  "start_col": 34
                }
              }
            ]
          },
          "span": {
            "start": 26,
            "end": 36,
            "start_line": 1,
            "start_col": 26
          }
        }
      },
      "span": {
        "start": 26,
        "end": 38,
        "start_line": 1,
        "start_col": 26
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
                  "start_line": 1,
                  "start_col": 44
                }
              }
            ]
          },
          "span": {
            "start": 38,
            "end": 46,
            "start_line": 1,
            "start_col": 38
          }
        }
      },
      "span": {
        "start": 38,
        "end": 48,
        "start_line": 1,
        "start_col": 38
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Array",
              {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 55,
                  "end": 57,
                  "start_line": 1,
                  "start_col": 55
                }
              }
            ]
          },
          "span": {
            "start": 48,
            "end": 57,
            "start_line": 1,
            "start_col": 48
          }
        }
      },
      "span": {
        "start": 48,
        "end": 59,
        "start_line": 1,
        "start_col": 48
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
                  "Variable": "c"
                },
                "span": {
                  "start": 67,
                  "end": 69,
                  "start_line": 1,
                  "start_col": 67
                }
              }
            ]
          },
          "span": {
            "start": 59,
            "end": 69,
            "start_line": 1,
            "start_col": 59
          }
        }
      },
      "span": {
        "start": 59,
        "end": 70,
        "start_line": 1,
        "start_col": 59
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

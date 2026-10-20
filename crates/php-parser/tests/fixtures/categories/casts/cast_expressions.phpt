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
                  "end": 13
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 13
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
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
                  "end": 24
                }
              }
            ]
          },
          "span": {
            "start": 15,
            "end": 24
          }
        }
      },
      "span": {
        "start": 15,
        "end": 25
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
                  "end": 36
                }
              }
            ]
          },
          "span": {
            "start": 26,
            "end": 36
          }
        }
      },
      "span": {
        "start": 26,
        "end": 37
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
                  "end": 46
                }
              }
            ]
          },
          "span": {
            "start": 38,
            "end": 46
          }
        }
      },
      "span": {
        "start": 38,
        "end": 47
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
                  "end": 57
                }
              }
            ]
          },
          "span": {
            "start": 48,
            "end": 57
          }
        }
      },
      "span": {
        "start": 48,
        "end": 58
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
                  "end": 69
                }
              }
            ]
          },
          "span": {
            "start": 59,
            "end": 69
          }
        }
      },
      "span": {
        "start": 59,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}

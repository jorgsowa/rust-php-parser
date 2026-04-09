===source===
<?php $obj instanceof Foo; $x instanceof Bar || $x instanceof Baz;
===ast===
{
  "stmts": [
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
                  "start": 6,
                  "end": 10,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 22,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 27,
                        "end": 29,
                        "start_line": 1,
                        "start_col": 27
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Bar"
                      },
                      "span": {
                        "start": 41,
                        "end": 44,
                        "start_line": 1,
                        "start_col": 41
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 44,
                  "start_line": 1,
                  "start_col": 27
                }
              },
              "op": "BooleanOr",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 48,
                        "end": 50,
                        "start_line": 1,
                        "start_col": 48
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Baz"
                      },
                      "span": {
                        "start": 62,
                        "end": 65,
                        "start_line": 1,
                        "start_col": 62
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 65,
                  "start_line": 1,
                  "start_col": 48
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 65,
            "start_line": 1,
            "start_col": 27
          }
        }
      },
      "span": {
        "start": 27,
        "end": 66,
        "start_line": 1,
        "start_col": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php $obj->$method(); $obj->{'get' . $field}();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
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
              "method": {
                "kind": {
                  "Variable": "method"
                },
                "span": {
                  "start": 12,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 12
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 23,
                  "end": 27,
                  "start_line": 1,
                  "start_col": 23
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "get"
                      },
                      "span": {
                        "start": 30,
                        "end": 35,
                        "start_line": 1,
                        "start_col": 30
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Variable": "field"
                      },
                      "span": {
                        "start": 38,
                        "end": 44,
                        "start_line": 1,
                        "start_col": 38
                      }
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 44,
                  "start_line": 1,
                  "start_col": 30
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 23,
            "end": 47,
            "start_line": 1,
            "start_col": 23
          }
        }
      },
      "span": {
        "start": 23,
        "end": 48,
        "start_line": 1,
        "start_col": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}

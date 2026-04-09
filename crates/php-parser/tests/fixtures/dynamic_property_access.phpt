===source===
<?php $obj->$prop; $obj->{$name . 'Suffix'};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
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
              "property": {
                "kind": {
                  "Variable": "prop"
                },
                "span": {
                  "start": 12,
                  "end": 17,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 19,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 19
                }
              },
              "property": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "name"
                      },
                      "span": {
                        "start": 26,
                        "end": 31,
                        "start_line": 1,
                        "start_col": 26
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "Suffix"
                      },
                      "span": {
                        "start": 34,
                        "end": 42,
                        "start_line": 1,
                        "start_col": 34
                      }
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 42,
                  "start_line": 1,
                  "start_col": 26
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 42,
            "start_line": 1,
            "start_col": 19
          }
        }
      },
      "span": {
        "start": 19,
        "end": 44,
        "start_line": 1,
        "start_col": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}

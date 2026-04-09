===source===
<?php $obj->name; $a->b->c;
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
                  "Identifier": "name"
                },
                "span": {
                  "start": 12,
                  "end": 16,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18,
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 18,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 18
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 22,
                        "end": 23,
                        "start_line": 1,
                        "start_col": 22
                      }
                    }
                  }
                },
                "span": {
                  "start": 18,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 18
                }
              },
              "property": {
                "kind": {
                  "Identifier": "c"
                },
                "span": {
                  "start": 25,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 25
                }
              }
            }
          },
          "span": {
            "start": 18,
            "end": 26,
            "start_line": 1,
            "start_col": 18
          }
        }
      },
      "span": {
        "start": 18,
        "end": 27,
        "start_line": 1,
        "start_col": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27,
    "start_line": 1,
    "start_col": 0
  }
}

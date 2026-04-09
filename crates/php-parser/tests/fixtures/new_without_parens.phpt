===source===
<?php $obj = new Foo; $bar = new Bar\Baz;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
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
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 17,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 17
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 13,
                  "end": 20,
                  "start_line": 1,
                  "start_col": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "bar"
                },
                "span": {
                  "start": 22,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 22
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Bar\\Baz"
                      },
                      "span": {
                        "start": 33,
                        "end": 40,
                        "start_line": 1,
                        "start_col": 33
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 29,
                  "end": 40,
                  "start_line": 1,
                  "start_col": 29
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 40,
            "start_line": 1,
            "start_col": 22
          }
        }
      },
      "span": {
        "start": 22,
        "end": 41,
        "start_line": 1,
        "start_col": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41,
    "start_line": 1,
    "start_col": 0
  }
}

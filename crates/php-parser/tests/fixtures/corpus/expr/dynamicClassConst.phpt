===source===
<?php
Foo::{bar()};
$foo::{bar()};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccessDynamic": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 6,
                  "end": 9,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "member": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "bar"
                      },
                      "span": {
                        "start": 12,
                        "end": 15,
                        "start_line": 2,
                        "start_col": 6
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 17,
                  "start_line": 2,
                  "start_col": 6
                }
              }
            }
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
            "ClassConstAccessDynamic": {
              "class": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 20,
                  "end": 24,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "member": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "bar"
                      },
                      "span": {
                        "start": 27,
                        "end": 30,
                        "start_line": 3,
                        "start_col": 7
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 27,
                  "end": 32,
                  "start_line": 3,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 33,
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
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}

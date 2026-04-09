===source===
<?php

foo()
bar()
baz()
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 7,
                  "end": 10,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 13,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 13,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 13,
                  "end": 16,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 13,
            "end": 19,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 13,
        "end": 19,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "baz"
                },
                "span": {
                  "start": 19,
                  "end": 22,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 19,
            "end": 24,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 19,
        "end": 24,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}

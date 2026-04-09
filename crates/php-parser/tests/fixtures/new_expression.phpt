===source===
<?php new Foo(); new $className(); new self();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 10,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 10
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 15,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Variable": "className"
                },
                "span": {
                  "start": 21,
                  "end": 31,
                  "start_line": 1,
                  "start_col": 21
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 17,
            "end": 33,
            "start_line": 1,
            "start_col": 17
          }
        }
      },
      "span": {
        "start": 17,
        "end": 35,
        "start_line": 1,
        "start_col": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "self"
                },
                "span": {
                  "start": 39,
                  "end": 43,
                  "start_line": 1,
                  "start_col": 39
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 35,
            "end": 45,
            "start_line": 1,
            "start_col": 35
          }
        }
      },
      "span": {
        "start": 35,
        "end": 46,
        "start_line": 1,
        "start_col": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46,
    "start_line": 1,
    "start_col": 0
  }
}

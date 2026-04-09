===source===
<?php $a ** $b instanceof Foo;
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 8,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 12,
                        "end": 14,
                        "start_line": 1,
                        "start_col": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14,
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
                  "start": 26,
                  "end": 29,
                  "start_line": 1,
                  "start_col": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30,
    "start_line": 1,
    "start_col": 0
  }
}

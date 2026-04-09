===source===
<?php $obj->{$prefix . 'Name'};
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "prefix"
                      },
                      "span": {
                        "start": 13,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 13
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "Name"
                      },
                      "span": {
                        "start": 23,
                        "end": 29,
                        "start_line": 1,
                        "start_col": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 29,
                  "start_line": 1,
                  "start_col": 13
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
        "end": 31,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31,
    "start_line": 1,
    "start_col": 0
  }
}

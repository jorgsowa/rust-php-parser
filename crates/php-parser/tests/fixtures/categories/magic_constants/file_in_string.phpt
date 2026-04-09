===source===
<?php $f = "loaded from " . __FILE__;
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
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "loaded from "
                      },
                      "span": {
                        "start": 11,
                        "end": 25,
                        "start_line": 1,
                        "start_col": 11
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "MagicConst": "File"
                      },
                      "span": {
                        "start": 28,
                        "end": 36,
                        "start_line": 1,
                        "start_col": 28
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 36,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}

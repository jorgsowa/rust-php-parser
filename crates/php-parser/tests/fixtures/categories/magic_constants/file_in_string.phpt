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
                  "end": 8
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
                        "end": 25
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "MagicConst": "File"
                      },
                      "span": {
                        "start": 28,
                        "end": 36
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}

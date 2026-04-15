===source===
<?php $a ?? $b = $c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "right": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 17,
                        "end": 19
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}

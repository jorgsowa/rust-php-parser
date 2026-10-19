===source===
<?php
$x = throw $e or 1;
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Throw": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "e"
                          },
                          "span": {
                            "start": 17,
                            "end": 19
                          }
                        },
                        "op": "LogicalOr",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 23,
                            "end": 24
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 17,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}

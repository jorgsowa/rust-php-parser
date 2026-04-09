===source===
<?php
try {
    $x;
} catch (X|Y $e1) {
    $y;
} catch (\A|B\C $e2) {
    $z;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 16,
                    "end": 18,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 20,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "X"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 29,
                    "end": 30,
                    "start_line": 4,
                    "start_col": 9
                  }
                },
                {
                  "parts": [
                    "Y"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 31,
                    "end": 33,
                    "start_line": 4,
                    "start_col": 11
                  }
                }
              ],
              "var": "e1",
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 44,
                        "end": 46,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 44,
                    "end": 48,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 28,
                "end": 50,
                "start_line": 4,
                "start_col": 8
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "A"
                  ],
                  "kind": "FullyQualified",
                  "span": {
                    "start": 57,
                    "end": 59,
                    "start_line": 6,
                    "start_col": 9
                  }
                },
                {
                  "parts": [
                    "B",
                    "C"
                  ],
                  "kind": "Qualified",
                  "span": {
                    "start": 60,
                    "end": 64,
                    "start_line": 6,
                    "start_col": 12
                  }
                }
              ],
              "var": "e2",
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Variable": "z"
                      },
                      "span": {
                        "start": 75,
                        "end": 77,
                        "start_line": 7,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 75,
                    "end": 79,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 56,
                "end": 80,
                "start_line": 6,
                "start_col": 8
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 80,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80,
    "start_line": 1,
    "start_col": 0
  }
}

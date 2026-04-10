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
                    "end": 18
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 19
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
                    "end": 30
                  }
                },
                {
                  "parts": [
                    "Y"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 31,
                    "end": 32
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
                        "end": 46
                      }
                    }
                  },
                  "span": {
                    "start": 44,
                    "end": 47
                  }
                }
              ],
              "span": {
                "start": 28,
                "end": 49
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
                    "end": 59
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
                    "end": 63
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
                        "end": 77
                      }
                    }
                  },
                  "span": {
                    "start": 75,
                    "end": 78
                  }
                }
              ],
              "span": {
                "start": 56,
                "end": 80
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}

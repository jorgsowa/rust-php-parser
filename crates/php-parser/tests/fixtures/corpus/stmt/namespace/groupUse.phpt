===source===
<?php
use A\{B};
use A\{B\C, D};
use \A\B\{C\D, E};
use function A\{b\c, d};
use const \A\{B\C, D};
use A\B\{C\D, function b\c, const D};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 14,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 13,
                "end": 14,
                "start_line": 2,
                "start_col": 7
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 17,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 21,
                  "end": 27,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 24,
                "end": 27,
                "start_line": 3,
                "start_col": 7
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "D"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 21,
                  "end": 30,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 29,
                "end": 30,
                "start_line": 3,
                "start_col": 12
              }
            }
          ]
        }
      },
      "span": {
        "start": 17,
        "end": 33,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "C",
                  "D"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 37,
                  "end": 46,
                  "start_line": 4,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 43,
                "end": 46,
                "start_line": 4,
                "start_col": 10
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "E"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 37,
                  "end": 49,
                  "start_line": 4,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 48,
                "end": 49,
                "start_line": 4,
                "start_col": 15
              }
            }
          ]
        }
      },
      "span": {
        "start": 33,
        "end": 52,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "b",
                  "c"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 65,
                  "end": 71,
                  "start_line": 5,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 68,
                "end": 71,
                "start_line": 5,
                "start_col": 16
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "d"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 65,
                  "end": 74,
                  "start_line": 5,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 73,
                "end": 74,
                "start_line": 5,
                "start_col": 21
              }
            }
          ]
        }
      },
      "span": {
        "start": 52,
        "end": 77,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Const",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "C"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 87,
                  "end": 94,
                  "start_line": 6,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 91,
                "end": 94,
                "start_line": 6,
                "start_col": 14
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "D"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 87,
                  "end": 97,
                  "start_line": 6,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 96,
                "end": 97,
                "start_line": 6,
                "start_col": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 77,
        "end": 100,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "C",
                  "D"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 104,
                  "end": 112,
                  "start_line": 7,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 109,
                "end": 112,
                "start_line": 7,
                "start_col": 9
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "b",
                  "c"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 104,
                  "end": 126,
                  "start_line": 7,
                  "start_col": 4
                }
              },
              "alias": null,
              "kind": "Function",
              "span": {
                "start": 114,
                "end": 126,
                "start_line": 7,
                "start_col": 14
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "D"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 104,
                  "end": 135,
                  "start_line": 7,
                  "start_col": 4
                }
              },
              "alias": null,
              "kind": "Const",
              "span": {
                "start": 128,
                "end": 135,
                "start_line": 7,
                "start_col": 28
              }
            }
          ]
        }
      },
      "span": {
        "start": 100,
        "end": 137,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 137,
    "start_line": 1,
    "start_col": 0
  }
}

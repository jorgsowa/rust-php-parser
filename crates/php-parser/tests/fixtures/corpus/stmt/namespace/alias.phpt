===source===
<?php

use A\B;
use C\D as E;
use F\G as H, J;

// evil alias notation - Do Not Use!
use \A;
use \A as B;

// function and constant aliases
use function foo\bar;
use function foo\bar as baz;
use const foo\BAR;
use const foo\BAR as BAZ;
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
                  "start": 11,
                  "end": 14,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 11,
                "end": 14,
                "start_line": 3,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 7,
        "end": 16,
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
                  "C",
                  "D"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 20,
                  "end": 24,
                  "start_line": 4,
                  "start_col": 4
                }
              },
              "alias": "E",
              "span": {
                "start": 20,
                "end": 28,
                "start_line": 4,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 16,
        "end": 30,
        "start_line": 4,
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
                  "F",
                  "G"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 34,
                  "end": 38,
                  "start_line": 5,
                  "start_col": 4
                }
              },
              "alias": "H",
              "span": {
                "start": 34,
                "end": 42,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "name": {
                "parts": [
                  "J"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 44,
                  "end": 45,
                  "start_line": 5,
                  "start_col": 14
                }
              },
              "alias": null,
              "span": {
                "start": 44,
                "end": 45,
                "start_line": 5,
                "start_col": 14
              }
            }
          ]
        }
      },
      "span": {
        "start": 30,
        "end": 85,
        "start_line": 5,
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
                  "A"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 89,
                  "end": 91,
                  "start_line": 8,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 89,
                "end": 91,
                "start_line": 8,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 85,
        "end": 93,
        "start_line": 8,
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
                  "A"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 97,
                  "end": 100,
                  "start_line": 9,
                  "start_col": 4
                }
              },
              "alias": "B",
              "span": {
                "start": 97,
                "end": 104,
                "start_line": 9,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 93,
        "end": 140,
        "start_line": 9,
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
                  "foo",
                  "bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 153,
                  "end": 160,
                  "start_line": 12,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 153,
                "end": 160,
                "start_line": 12,
                "start_col": 13
              }
            }
          ]
        }
      },
      "span": {
        "start": 140,
        "end": 162,
        "start_line": 12,
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
                  "foo",
                  "bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 175,
                  "end": 183,
                  "start_line": 13,
                  "start_col": 13
                }
              },
              "alias": "baz",
              "span": {
                "start": 175,
                "end": 189,
                "start_line": 13,
                "start_col": 13
              }
            }
          ]
        }
      },
      "span": {
        "start": 162,
        "end": 191,
        "start_line": 13,
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
                  "foo",
                  "BAR"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 201,
                  "end": 208,
                  "start_line": 14,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 201,
                "end": 208,
                "start_line": 14,
                "start_col": 10
              }
            }
          ]
        }
      },
      "span": {
        "start": 191,
        "end": 210,
        "start_line": 14,
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
                  "foo",
                  "BAR"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 220,
                  "end": 228,
                  "start_line": 15,
                  "start_col": 10
                }
              },
              "alias": "BAZ",
              "span": {
                "start": 220,
                "end": 234,
                "start_line": 15,
                "start_col": 10
              }
            }
          ]
        }
      },
      "span": {
        "start": 210,
        "end": 235,
        "start_line": 15,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 235,
    "start_line": 1,
    "start_col": 0
  }
}

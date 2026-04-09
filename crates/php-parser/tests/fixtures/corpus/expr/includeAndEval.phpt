===source===
<?php
include 'A.php';
include_once 'A.php';
require 'A.php';
require_once 'A.php';
eval('A');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Include",
              {
                "kind": {
                  "String": "A.php"
                },
                "span": {
                  "start": 14,
                  "end": 21,
                  "start_line": 2,
                  "start_col": 8
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "IncludeOnce",
              {
                "kind": {
                  "String": "A.php"
                },
                "span": {
                  "start": 36,
                  "end": 43,
                  "start_line": 3,
                  "start_col": 13
                }
              }
            ]
          },
          "span": {
            "start": 23,
            "end": 43,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 23,
        "end": 45,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Require",
              {
                "kind": {
                  "String": "A.php"
                },
                "span": {
                  "start": 53,
                  "end": 60,
                  "start_line": 4,
                  "start_col": 8
                }
              }
            ]
          },
          "span": {
            "start": 45,
            "end": 60,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 45,
        "end": 62,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "RequireOnce",
              {
                "kind": {
                  "String": "A.php"
                },
                "span": {
                  "start": 75,
                  "end": 82,
                  "start_line": 5,
                  "start_col": 13
                }
              }
            ]
          },
          "span": {
            "start": 62,
            "end": 82,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 62,
        "end": 84,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Eval": {
              "kind": {
                "String": "A"
              },
              "span": {
                "start": 89,
                "end": 92,
                "start_line": 6,
                "start_col": 5
              }
            }
          },
          "span": {
            "start": 84,
            "end": 93,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 84,
        "end": 94,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94,
    "start_line": 1,
    "start_col": 0
  }
}

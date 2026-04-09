===source===
<?php

switch ($a) {
    case 0:
        break;
    // Comment
    case 1;
    default:
}

// alternative syntax
switch ($a):
endswitch;

// leading semicolon
switch ($a) { ; }
switch ($a): ; endswitch;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17,
              "start_line": 3,
              "start_col": 8
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 30,
                  "end": 31,
                  "start_line": 4,
                  "start_col": 9
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 41,
                    "end": 67,
                    "start_line": 5,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 25,
                "end": 67,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 72,
                  "end": 73,
                  "start_line": 7,
                  "start_col": 9
                }
              },
              "body": [],
              "span": {
                "start": 67,
                "end": 79,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "value": null,
              "body": [],
              "span": {
                "start": 79,
                "end": 88,
                "start_line": 8,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 7,
        "end": 113,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 121,
              "end": 123,
              "start_line": 12,
              "start_col": 8
            }
          },
          "cases": []
        }
      },
      "span": {
        "start": 113,
        "end": 159,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 167,
              "end": 169,
              "start_line": 16,
              "start_col": 8
            }
          },
          "cases": []
        }
      },
      "span": {
        "start": 159,
        "end": 177,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 185,
              "end": 187,
              "start_line": 17,
              "start_col": 8
            }
          },
          "cases": []
        }
      },
      "span": {
        "start": 177,
        "end": 202,
        "start_line": 17,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 202,
    "start_line": 1,
    "start_col": 0
  }
}

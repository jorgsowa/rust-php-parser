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
              "end": 17
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
                  "end": 31
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 41,
                    "end": 47
                  }
                }
              ],
              "span": {
                "start": 25,
                "end": 47
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 72,
                  "end": 73
                }
              },
              "body": [],
              "span": {
                "start": 67,
                "end": 74
              }
            },
            {
              "value": null,
              "body": [],
              "span": {
                "start": 79,
                "end": 87
              }
            }
          ]
        }
      },
      "span": {
        "start": 7,
        "end": 89
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
              "end": 123
            }
          },
          "cases": []
        }
      },
      "span": {
        "start": 113,
        "end": 136
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
              "end": 169
            }
          },
          "cases": []
        }
      },
      "span": {
        "start": 159,
        "end": 176
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
              "end": 187
            }
          },
          "cases": []
        }
      },
      "span": {
        "start": 177,
        "end": 202
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 202
  }
}

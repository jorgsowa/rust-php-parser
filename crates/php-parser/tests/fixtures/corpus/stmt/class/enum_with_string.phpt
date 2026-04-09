===source===
<?php

enum Suit: string
{
    case Hearts = 'H';
    case Diamonds;
    case Clubs = 'C';
    case Spades = 'S';
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Suit",
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 18,
              "end": 25,
              "start_line": 3,
              "start_col": 11
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Hearts",
                  "value": {
                    "kind": {
                      "String": "H"
                    },
                    "span": {
                      "start": 45,
                      "end": 48,
                      "start_line": 5,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 54,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Diamonds",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 73,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Clubs",
                  "value": {
                    "kind": {
                      "String": "C"
                    },
                    "span": {
                      "start": 86,
                      "end": 89,
                      "start_line": 7,
                      "start_col": 17
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 73,
                "end": 95,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Spades",
                  "value": {
                    "kind": {
                      "String": "S"
                    },
                    "span": {
                      "start": 109,
                      "end": 112,
                      "start_line": 8,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 95,
                "end": 114,
                "start_line": 8,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 115,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115,
    "start_line": 1,
    "start_col": 0
  }
}

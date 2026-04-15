===config===
min_php=8.5
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
              "end": 24
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
                      "end": 48
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 49
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
                "end": 68
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
                      "end": 89
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 73,
                "end": 90
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
                      "end": 112
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 95,
                "end": 113
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 115
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115
  }
}
===php_error===
PHP Fatal error:  Case Diamonds of backed enum Suit must have a value in Standard input code on line 6
Stack trace:
#0 {main}

===source===
<?php

enum Suit: string
{
    case Hearts = 'H';
    case Diamonds;
    case Clubs = 'C';
    case Spades = 'S';
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Case Diamonds of backed enum Suit must have a value
===errors >=8.1===
Case Diamonds of backed enum Suit must have a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Suit' (T_STRING) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Suit" in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Case Diamonds of backed enum Suit must have a value in Standard input code on line 6
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Suit",
            "span": {
              "start": 12,
              "end": 16
            }
          },
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
                  "name": {
                    "name": "Hearts",
                    "span": {
                      "start": 36,
                      "end": 42
                    }
                  },
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
                  "name": {
                    "name": "Diamonds",
                    "span": {
                      "start": 59,
                      "end": 67
                    }
                  },
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
                  "name": {
                    "name": "Clubs",
                    "span": {
                      "start": 78,
                      "end": 83
                    }
                  },
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
                  "name": {
                    "name": "Spades",
                    "span": {
                      "start": 100,
                      "end": 106
                    }
                  },
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

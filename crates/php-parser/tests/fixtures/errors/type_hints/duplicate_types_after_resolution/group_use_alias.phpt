===source===
<?php
namespace N;
use X\{C, D as E};
function e(): \X\D|E {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type X\D is redundant
===errors >=8.0===
Duplicate type X\D is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 4
===php_error >=8.0===
PHP Fatal error:  Duplicate type X\D is redundant in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
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
                  "X",
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 26,
                  "end": 27
                }
              },
              "alias": null,
              "span": {
                "start": 26,
                "end": 27
              }
            },
            {
              "name": {
                "parts": [
                  "X",
                  "D"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 29,
                  "end": 30
                }
              },
              "alias": {
                "name": "E",
                "span": {
                  "start": 34,
                  "end": 35
                }
              },
              "span": {
                "start": 29,
                "end": 35
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 37
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "e",
            "span": {
              "start": 47,
              "end": 48
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "X",
                        "D"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 52,
                        "end": 56
                      }
                    }
                  },
                  "span": {
                    "start": 52,
                    "end": 56
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "E"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 57,
                        "end": 58
                      }
                    }
                  },
                  "span": {
                    "start": 57,
                    "end": 58
                  }
                }
              ]
            },
            "span": {
              "start": 52,
              "end": 58
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 38,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}

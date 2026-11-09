===source===
<?php
namespace N;
use X\A as B;
function c(): \X\A|B {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type X\A is redundant
===errors >=8.0===
Duplicate type X\A is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 4
===php_error >=8.0===
PHP Fatal error:  Duplicate type X\A is redundant in Standard input code on line 4
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
                  "A"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 23,
                  "end": 26
                }
              },
              "alias": {
                "name": "B",
                "span": {
                  "start": 30,
                  "end": 31
                }
              },
              "span": {
                "start": 23,
                "end": 31
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 32
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 42,
              "end": 43
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
                        "A"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 47,
                        "end": 51
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 51
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 52,
                        "end": 53
                      }
                    }
                  },
                  "span": {
                    "start": 52,
                    "end": 53
                  }
                }
              ]
            },
            "span": {
              "start": 47,
              "end": 53
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 33,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}

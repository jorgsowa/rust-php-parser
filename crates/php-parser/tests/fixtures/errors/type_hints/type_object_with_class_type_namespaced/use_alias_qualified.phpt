===source===
<?php
namespace N;
use X\Z as W;
function c(): object|W\V {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Type X\Z\V|object contains both object and a class type, which is redundant
===errors >=8.0===
Type X\Z\V|object contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 4
===php_error >=8.0===
PHP Fatal error:  Type X\Z\V|object contains both object and a class type, which is redundant in Standard input code on line 4
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
                  "Z"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 23,
                  "end": 26
                }
              },
              "alias": {
                "name": "W",
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
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 47,
                        "end": 53
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 53
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "W",
                        "V"
                      ],
                      "kind": "Qualified",
                      "span": {
                        "start": 54,
                        "end": 57
                      }
                    }
                  },
                  "span": {
                    "start": 54,
                    "end": 57
                  }
                }
              ]
            },
            "span": {
              "start": 47,
              "end": 57
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 33,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}

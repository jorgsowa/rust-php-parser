===source===
<?php
namespace N;
use X\Y;
function b(): Y|object {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Type X\Y|object contains both object and a class type, which is redundant
===errors >=8.0===
Type X\Y|object contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 4
===php_error >=8.0===
PHP Fatal error:  Type X\Y|object contains both object and a class type, which is redundant in Standard input code on line 4
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
                  "Y"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 23,
                  "end": 26
                }
              },
              "alias": null,
              "span": {
                "start": 23,
                "end": 26
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 27
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 37,
              "end": 38
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
                        "Y"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 42,
                        "end": 43
                      }
                    }
                  },
                  "span": {
                    "start": 42,
                    "end": 43
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 44,
                        "end": 50
                      }
                    }
                  },
                  "span": {
                    "start": 44,
                    "end": 50
                  }
                }
              ]
            },
            "span": {
              "start": 42,
              "end": 50
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 28,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}

===source===
<?php
namespace N;
function a(): \N\F|F {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type N\F is redundant
===errors >=8.0===
Duplicate type N\F is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Duplicate type N\F is redundant in Standard input code on line 3
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
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 28,
              "end": 29
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
                        "N",
                        "F"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 33,
                        "end": 37
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 37
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "F"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 38,
                        "end": 39
                      }
                    }
                  },
                  "span": {
                    "start": 38,
                    "end": 39
                  }
                }
              ]
            },
            "span": {
              "start": 33,
              "end": 39
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}

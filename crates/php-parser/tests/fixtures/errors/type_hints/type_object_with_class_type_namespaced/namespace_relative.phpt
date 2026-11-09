===source===
<?php
namespace N;
function e(): object|namespace\H {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Type N\H|object contains both object and a class type, which is redundant
===errors >=8.0===
Type N\H|object contains both object and a class type, which is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Type N\H|object contains both object and a class type, which is redundant in Standard input code on line 3
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
            "name": "e",
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
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 33,
                        "end": 39
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 39
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "H"
                      ],
                      "kind": "Relative",
                      "span": {
                        "start": 40,
                        "end": 51
                      }
                    }
                  },
                  "span": {
                    "start": 40,
                    "end": 51
                  }
                }
              ]
            },
            "span": {
              "start": 33,
              "end": 51
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}

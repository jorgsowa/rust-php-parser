===source===
<?php
namespace N;
function b(): namespace\G|G {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type N\G is redundant
===errors >=8.0===
Duplicate type N\G is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Duplicate type N\G is redundant in Standard input code on line 3
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
            "name": "b",
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
                        "G"
                      ],
                      "kind": "Relative",
                      "span": {
                        "start": 33,
                        "end": 44
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 44
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "G"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 45,
                        "end": 46
                      }
                    }
                  },
                  "span": {
                    "start": 45,
                    "end": 46
                  }
                }
              ]
            },
            "span": {
              "start": 33,
              "end": 46
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}

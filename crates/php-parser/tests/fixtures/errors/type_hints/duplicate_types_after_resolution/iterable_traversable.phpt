===source===
<?php
namespace N;
function f(): iterable|\Traversable {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type Traversable is redundant
===errors >=8.0===
Duplicate type Traversable is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 3
===php_error 8.0-8.1===
PHP Fatal error:  Type Traversable|iterable contains both iterable and Traversable, which is redundant in Standard input code on line 3
===php_error >=8.2===
PHP Fatal error:  Duplicate type Traversable is redundant in Standard input code on line 3
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
            "name": "f",
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
                        "iterable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 33,
                        "end": 41
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 41
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Traversable"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 42,
                        "end": 54
                      }
                    }
                  },
                  "span": {
                    "start": 42,
                    "end": 54
                  }
                }
              ]
            },
            "span": {
              "start": 33,
              "end": 54
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}

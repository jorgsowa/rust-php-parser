===source===
<?php
function c(): \iterable|\Traversable {}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Type declaration 'iterable' must be unqualified
===errors >=8.0===
Type declaration 'iterable' must be unqualified
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Type declaration 'iterable' must be unqualified in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 15,
              "end": 16
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
                      "kind": "FullyQualified",
                      "span": {
                        "start": 20,
                        "end": 29
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 29
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
                        "start": 30,
                        "end": 42
                      }
                    }
                  },
                  "span": {
                    "start": 30,
                    "end": 42
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 42
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}

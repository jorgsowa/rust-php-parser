===source===
<?php
#[A(1, ?)]
function f() {}
===errors 8.0-8.5===
'partial function application' requires PHP 8.6 or higher
===errors >=8.6===
Cannot create Closure as attribute argument
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?", expecting ")" in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Cannot create Closure as attribute argument in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 26,
              "end": 27
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 17,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 26,
              "end": 27
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 10,
                        "end": 11
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 11
                  }
                },
                {
                  "name": null,
                  "kind": "Placeholder",
                  "span": {
                    "start": 13,
                    "end": 14
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 15
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}

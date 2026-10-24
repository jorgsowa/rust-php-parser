===source===
<?php
#[A,
  B]
function f() {}
===errors <=7.4===
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ']' in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "B"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 13,
                "end": 14
              }
            }
          },
          "span": {
            "start": 13,
            "end": 14
          }
        }
      },
      "span": {
        "start": 13,
        "end": 14
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 14,
        "end": 15
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 25,
              "end": 26
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
        "start": 16,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
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
              "start": 25,
              "end": 26
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
              "args": [],
              "span": {
                "start": 8,
                "end": 9
              }
            },
            {
              "name": {
                "parts": [
                  "B"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 13,
                  "end": 14
                }
              },
              "args": [],
              "span": {
                "start": 13,
                "end": 14
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}

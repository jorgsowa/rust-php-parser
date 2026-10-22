===source===
<?php
function f(): int { return; }
===errors===
A function with return type must return a value
===php_error===
PHP Fatal error:  A function with return type must return a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": null
              },
              "span": {
                "start": 26,
                "end": 33
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "int"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 23
                }
              }
            },
            "span": {
              "start": 20,
              "end": 23
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}

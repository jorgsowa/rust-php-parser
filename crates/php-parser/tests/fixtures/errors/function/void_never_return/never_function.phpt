===source===
<?php
function n(): never { return; }
===errors <=8.0===
A function with return type must return a value
===errors >=8.1===
A never-returning function must not return
===php_error <=8.0===
PHP Fatal error:  A function with return type must return a value in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  A never-returning function must not return in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "n",
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
                "start": 28,
                "end": 35
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 25
                }
              }
            },
            "span": {
              "start": 20,
              "end": 25
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}

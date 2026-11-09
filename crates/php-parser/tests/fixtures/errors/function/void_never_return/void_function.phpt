===source===
<?php
function v(): void { return 5; }
===errors===
A void function must not return a value
===php_error===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "v",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 5
                  },
                  "span": {
                    "start": 34,
                    "end": 35
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 36
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 24
                }
              }
            },
            "span": {
              "start": 20,
              "end": 24
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}

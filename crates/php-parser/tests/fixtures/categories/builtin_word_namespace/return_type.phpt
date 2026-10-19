===source===
<?php
function f(): void\X {}
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
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void",
                  "X"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 20,
                  "end": 26
                }
              }
            },
            "span": {
              "start": 20,
              "end": 26
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}

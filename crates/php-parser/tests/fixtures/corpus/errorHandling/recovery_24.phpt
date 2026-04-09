===source===
<?php
function foo() :
{
    return $a;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 36,
                    "end": 38,
                    "start_line": 4,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 29,
                "end": 40,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "<error>"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 23,
                  "end": 23,
                  "start_line": 3,
                  "start_col": 0
                }
              }
            },
            "span": {
              "start": 23,
              "end": 23,
              "start_line": 3,
              "start_col": 0
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41,
    "start_line": 1,
    "start_col": 0
  }
}

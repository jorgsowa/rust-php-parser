===source===
<?php
$foo->
;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "property": {
                "kind": "Error",
                "span": {
                  "start": 13,
                  "end": 14,
                  "start_line": 3,
                  "start_col": 0
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14,
    "start_line": 1,
    "start_col": 0
  }
}

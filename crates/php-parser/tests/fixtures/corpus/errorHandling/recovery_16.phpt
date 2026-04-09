===source===
<?php
Foo::
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 6,
                  "end": 9,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "member": "<error>"
            }
          },
          "span": {
            "start": 6,
            "end": 11,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 11,
    "start_line": 1,
    "start_col": 0
  }
}

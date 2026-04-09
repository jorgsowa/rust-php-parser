===source===
<?php
/* Comment */
;
namespace Foo;
===ast===
{
  "stmts": [
    {
      "kind": "Nop",
      "span": {
        "start": 20,
        "end": 21,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Foo"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 32,
              "end": 35,
              "start_line": 4,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 22,
        "end": 36,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}

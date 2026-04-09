===source===
<?php
// Extra NS separator
use Foo\{\Bar};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 32,
                  "end": 41,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 37,
                "end": 41,
                "start_line": 3,
                "start_col": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 28,
        "end": 43,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43,
    "start_line": 1,
    "start_col": 0
  }
}

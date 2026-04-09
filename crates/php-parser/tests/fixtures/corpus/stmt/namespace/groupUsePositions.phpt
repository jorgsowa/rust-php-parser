===source===
<?php
use Foo\Bar\{Baz};
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
                  "Bar",
                  "Baz"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 22,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 19,
                "end": 22,
                "start_line": 2,
                "start_col": 13
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}

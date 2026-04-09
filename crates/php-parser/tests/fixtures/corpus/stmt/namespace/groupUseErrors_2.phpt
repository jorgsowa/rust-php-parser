===source===
<?php
// Missing NS separator
use Foo {Bar, Baz};
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
                  "start": 34,
                  "end": 42,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 39,
                "end": 42,
                "start_line": 3,
                "start_col": 9
              }
            },
            {
              "name": {
                "parts": [
                  "Foo",
                  "Baz"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 34,
                  "end": 47,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 44,
                "end": 47,
                "start_line": 3,
                "start_col": 14
              }
            }
          ]
        }
      },
      "span": {
        "start": 30,
        "end": 49,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49,
    "start_line": 1,
    "start_col": 0
  }
}

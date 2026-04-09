===source===
<?php namespace ; namespace Foo\Bar;
===errors===
expected identifier, found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "<error>"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 16,
              "start_line": 1,
              "start_col": 16
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Foo",
              "Bar"
            ],
            "kind": "Qualified",
            "span": {
              "start": 28,
              "end": 35,
              "start_line": 1,
              "start_col": 28
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 18,
        "end": 36,
        "start_line": 1,
        "start_col": 18
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

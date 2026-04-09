===source===
<?php

namespace Foo\Bar;
foo;

namespace Bar;
bar;
===ast===
{
  "stmts": [
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
              "start": 17,
              "end": 24,
              "start_line": 3,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 7,
        "end": 26,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "foo"
          },
          "span": {
            "start": 26,
            "end": 29,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 26,
        "end": 32,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Bar"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 42,
              "end": 45,
              "start_line": 6,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 32,
        "end": 47,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "bar"
          },
          "span": {
            "start": 47,
            "end": 50,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 47,
        "end": 51,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php

A;
A\B;
\A\B;
namespace\A\B;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "A"
          },
          "span": {
            "start": 7,
            "end": 8,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 10,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "A\\B"
          },
          "span": {
            "start": 10,
            "end": 13,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 10,
        "end": 15,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "\\A\\B"
          },
          "span": {
            "start": 15,
            "end": 19,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 15,
        "end": 21,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "namespace\\A\\B"
          },
          "span": {
            "start": 21,
            "end": 34,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 21,
        "end": 35,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}

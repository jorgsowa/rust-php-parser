===source===
<?php

echo 'Hallo World!';
echo 'Hallo', ' ', 'World', '!';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "Hallo World!"
            },
            "span": {
              "start": 12,
              "end": 26,
              "start_line": 3,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 28,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "Hallo"
            },
            "span": {
              "start": 33,
              "end": 40,
              "start_line": 4,
              "start_col": 5
            }
          },
          {
            "kind": {
              "String": " "
            },
            "span": {
              "start": 42,
              "end": 45,
              "start_line": 4,
              "start_col": 14
            }
          },
          {
            "kind": {
              "String": "World"
            },
            "span": {
              "start": 47,
              "end": 54,
              "start_line": 4,
              "start_col": 19
            }
          },
          {
            "kind": {
              "String": "!"
            },
            "span": {
              "start": 56,
              "end": 59,
              "start_line": 4,
              "start_col": 28
            }
          }
        ]
      },
      "span": {
        "start": 28,
        "end": 60,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php
goto end;
echo 'this is skipped';
end:
echo 'done';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Goto": "end"
      },
      "span": {
        "start": 6,
        "end": 16,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "this is skipped"
            },
            "span": {
              "start": 21,
              "end": 38,
              "start_line": 3,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 16,
        "end": 40,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Label": "end"
      },
      "span": {
        "start": 40,
        "end": 45,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "done"
            },
            "span": {
              "start": 50,
              "end": 56,
              "start_line": 5,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 45,
        "end": 57,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57,
    "start_line": 1,
    "start_col": 0
  }
}

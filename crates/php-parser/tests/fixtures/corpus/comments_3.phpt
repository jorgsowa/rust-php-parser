===source===
<?php

// comment
if (42) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Int": 42
            },
            "span": {
              "start": 22,
              "end": 24,
              "start_line": 4,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 26,
              "end": 28,
              "start_line": 4,
              "start_col": 8
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 18,
        "end": 28,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28,
    "start_line": 1,
    "start_col": 0
  }
}

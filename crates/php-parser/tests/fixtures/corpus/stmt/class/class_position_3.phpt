===source===
<?php

if (1);

interface X {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 11,
              "end": 12,
              "start_line": 3,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": "Nop",
            "span": {
              "start": 13,
              "end": 14,
              "start_line": 3,
              "start_col": 6
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 7,
        "end": 14,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Interface": {
          "name": "X",
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 16,
        "end": 30,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30,
    "start_line": 1,
    "start_col": 0
  }
}

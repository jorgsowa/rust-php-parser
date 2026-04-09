===source===
<?php

if (1);

class C {}
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
        "Class": {
          "name": "C",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 16,
        "end": 26,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26,
    "start_line": 1,
    "start_col": 0
  }
}

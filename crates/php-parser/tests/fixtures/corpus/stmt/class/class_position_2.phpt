===source===
<?php

if (1);

trait X {}
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
              "end": 12
            }
          },
          "then_branch": {
            "kind": "Nop",
            "span": {
              "start": 13,
              "end": 14
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 7,
        "end": 14
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "X",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 16,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}

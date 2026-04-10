===source===
<?php

/** doc 1 */
/* foobar 1 */
// foo 1
// bar 1
$var;

if ($cond) {
    /** doc 2 */
    /* foobar 2 */
    // foo 2
    // bar 2
}

/** doc 3 */
/* foobar 3 */
// foo 3
// bar 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "var"
          },
          "span": {
            "start": 53,
            "end": 57
          }
        }
      },
      "span": {
        "start": 53,
        "end": 58
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "cond"
            },
            "span": {
              "start": 64,
              "end": 69
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 71,
              "end": 136
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 60,
        "end": 136
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 136
  }
}

===source===
<?php
if ($a) goto labelA;
if ($b) goto labelB;
labelA:
echo 'A';
goto end;
labelB:
echo 'B';
end:
echo 'done';
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 10,
              "end": 12,
              "start_line": 2,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Goto": "labelA"
            },
            "span": {
              "start": 14,
              "end": 27,
              "start_line": 2,
              "start_col": 8
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 31,
              "end": 33,
              "start_line": 3,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Goto": "labelB"
            },
            "span": {
              "start": 35,
              "end": 48,
              "start_line": 3,
              "start_col": 8
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 27,
        "end": 48,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Label": "labelA"
      },
      "span": {
        "start": 48,
        "end": 56,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "A"
            },
            "span": {
              "start": 61,
              "end": 64,
              "start_line": 5,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 56,
        "end": 66,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Goto": "end"
      },
      "span": {
        "start": 66,
        "end": 76,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Label": "labelB"
      },
      "span": {
        "start": 76,
        "end": 84,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "B"
            },
            "span": {
              "start": 89,
              "end": 92,
              "start_line": 8,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 84,
        "end": 94,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Label": "end"
      },
      "span": {
        "start": 94,
        "end": 99,
        "start_line": 9,
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
              "start": 104,
              "end": 110,
              "start_line": 10,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 99,
        "end": 111,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 111,
    "start_line": 1,
    "start_col": 0
  }
}

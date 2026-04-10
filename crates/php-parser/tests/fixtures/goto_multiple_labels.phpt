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
              "end": 12
            }
          },
          "then_branch": {
            "kind": {
              "Goto": "labelA"
            },
            "span": {
              "start": 14,
              "end": 26
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 26
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
              "end": 33
            }
          },
          "then_branch": {
            "kind": {
              "Goto": "labelB"
            },
            "span": {
              "start": 35,
              "end": 47
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 27,
        "end": 47
      }
    },
    {
      "kind": {
        "Label": "labelA"
      },
      "span": {
        "start": 48,
        "end": 55
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
              "end": 64
            }
          }
        ]
      },
      "span": {
        "start": 56,
        "end": 65
      }
    },
    {
      "kind": {
        "Goto": "end"
      },
      "span": {
        "start": 66,
        "end": 75
      }
    },
    {
      "kind": {
        "Label": "labelB"
      },
      "span": {
        "start": 76,
        "end": 83
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
              "end": 92
            }
          }
        ]
      },
      "span": {
        "start": 84,
        "end": 93
      }
    },
    {
      "kind": {
        "Label": "end"
      },
      "span": {
        "start": 94,
        "end": 98
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
              "end": 110
            }
          }
        ]
      },
      "span": {
        "start": 99,
        "end": 111
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 111
  }
}

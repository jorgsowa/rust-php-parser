===source===
<?php if ($a) ?>x<?php while ($b) ?>y<?php echo 1;
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
            "kind": "Nop",
            "span": {
              "start": 14,
              "end": 16
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "InlineHtml": "x"
      },
      "span": {
        "start": 16,
        "end": 17
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 30,
              "end": 32
            }
          },
          "body": {
            "kind": "Nop",
            "span": {
              "start": 34,
              "end": 36
            }
          }
        }
      },
      "span": {
        "start": 23,
        "end": 36
      }
    },
    {
      "kind": {
        "InlineHtml": "y"
      },
      "span": {
        "start": 36,
        "end": 37
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 48,
              "end": 49
            }
          }
        ]
      },
      "span": {
        "start": 43,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}

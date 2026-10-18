===source===
<?php switch ($a): ?>
<?php case 1: ?>one<?php break; ?>
<?php endswitch; ?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 14,
              "end": 16
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 33,
                  "end": 34
                }
              },
              "body": [
                {
                  "kind": {
                    "InlineHtml": "one"
                  },
                  "span": {
                    "start": 38,
                    "end": 41
                  }
                },
                {
                  "kind": "Nop",
                  "span": {
                    "start": 47,
                    "end": 52
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 47,
                    "end": 53
                  }
                },
                {
                  "kind": {
                    "InlineHtml": "\n"
                  },
                  "span": {
                    "start": 56,
                    "end": 57
                  }
                },
                {
                  "kind": "Nop",
                  "span": {
                    "start": 63,
                    "end": 72
                  }
                }
              ],
              "span": {
                "start": 28,
                "end": 62
              }
            }
          ],
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}

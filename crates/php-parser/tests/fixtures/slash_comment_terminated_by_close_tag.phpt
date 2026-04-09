===source===
<?php // comment ?>
<div>html</div>
<?php $x = 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "InlineHtml": "\n<div>html</div>\n"
      },
      "span": {
        "start": 19,
        "end": 36,
        "start_line": 1,
        "start_col": 19
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 42,
                  "end": 44,
                  "start_line": 3,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 47,
                  "end": 48,
                  "start_line": 3,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 48,
            "start_line": 3,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 42,
        "end": 49,
        "start_line": 3,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49,
    "start_line": 1,
    "start_col": 0
  }
}

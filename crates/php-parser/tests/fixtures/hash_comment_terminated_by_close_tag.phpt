===source===
<?php # comment ?>
<span>html</span>
<?php $x = 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "InlineHtml": "\n<span>html</span>\n"
      },
      "span": {
        "start": 18,
        "end": 37,
        "start_line": 1,
        "start_col": 18
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
                  "start": 43,
                  "end": 45,
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
                  "start": 48,
                  "end": 49,
                  "start_line": 3,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 49,
            "start_line": 3,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 43,
        "end": 50,
        "start_line": 3,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50,
    "start_line": 1,
    "start_col": 0
  }
}

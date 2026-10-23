===source===
<?php # comment ?>
<span>html</span>
<?php $x = 1;
===ast===
{
  "stmts": [
    {
      "kind": "Nop",
      "span": {
        "start": 16,
        "end": 19
      }
    },
    {
      "kind": {
        "InlineHtml": "<span>html</span>\n"
      },
      "span": {
        "start": 19,
        "end": 37
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
                  "end": 45
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 48,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 49
          }
        }
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

===source===
<?php // comment ?>
<div>html</div>
<?php $x = 1;
===ast===
{
  "stmts": [
    {
      "kind": "Nop",
      "span": {
        "start": 17,
        "end": 20
      }
    },
    {
      "kind": {
        "InlineHtml": "<div>html</div>\n"
      },
      "span": {
        "start": 20,
        "end": 36
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
                  "end": 44
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 47,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 48
          }
        }
      },
      "span": {
        "start": 42,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}

===source===
<?php
switch ($a) { case 1 ?>x<?php break; }
===ast >=8.5===
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
                  "start": 25,
                  "end": 26
                }
              },
              "body": [
                {
                  "kind": {
                    "InlineHtml": "x"
                  },
                  "span": {
                    "start": 29,
                    "end": 30
                  }
                },
                {
                  "kind": "Nop",
                  "span": {
                    "start": 36,
                    "end": 41
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 36,
                    "end": 42
                  }
                }
              ],
              "span": {
                "start": 20,
                "end": 42
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}

===source===
<?php $x = 1.000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000;
===ast===
{
  "stmts": [
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
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Float": 1.0
                },
                "span": {
                  "start": 11,
                  "end": 145
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 145
          }
        }
      },
      "span": {
        "start": 6,
        "end": 146
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 146
  }
}

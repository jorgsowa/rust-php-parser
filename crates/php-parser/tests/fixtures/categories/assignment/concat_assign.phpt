===source===
<?php $str .= ' world';
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
                  "Variable": "str"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "String": " world"
                },
                "span": {
                  "start": 14,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}

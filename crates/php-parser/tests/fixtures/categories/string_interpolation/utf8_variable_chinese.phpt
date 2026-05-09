===source===
<?php
$变量 = "chinese";
echo "Value: $变量";
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
                  "Variable": "变量"
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "chinese"
                },
                "span": {
                  "start": 16,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Value: "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "变量"
                    },
                    "span": {
                      "start": 40,
                      "end": 47
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 32,
              "end": 48
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}

===source===
<?php
$𝕾𝖈𝖔𝖕𝖙 = "4byte";
echo "Math alphanumeric: $𝕾𝖈𝖔𝖕𝖙";
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
                  "Variable": "𝕾𝖈𝖔𝖕𝖙"
                },
                "span": {
                  "start": 6,
                  "end": 27
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "4byte"
                },
                "span": {
                  "start": 30,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 37
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Math alphanumeric: "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "𝕾𝖈𝖔𝖕𝖙"
                    },
                    "span": {
                      "start": 64,
                      "end": 85
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 44,
              "end": 86
            }
          }
        ]
      },
      "span": {
        "start": 39,
        "end": 87
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87
  }
}

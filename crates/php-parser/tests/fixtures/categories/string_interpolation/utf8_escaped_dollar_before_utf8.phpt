===source===
<?php
$переменная = "value";
echo "Not a var: \$переменная is escaped";
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
                  "Variable": "переменная"
                },
                "span": {
                  "start": 6,
                  "end": 27
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "value"
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
              "String": "Not a var: $переменная is escaped"
            },
            "span": {
              "start": 44,
              "end": 90
            }
          }
        ]
      },
      "span": {
        "start": 39,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}

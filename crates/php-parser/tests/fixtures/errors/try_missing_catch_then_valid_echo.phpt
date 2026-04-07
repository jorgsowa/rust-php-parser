===source===
<?php try { $x = 1; } echo 'after';
===errors===
expected catch or finally clause, found 'echo'
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                          "start": 12,
                          "end": 14
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 17,
                          "end": 18
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 18
                  }
                }
              },
              "span": {
                "start": 12,
                "end": 20
              }
            }
          ],
          "catches": [],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "after"
            },
            "span": {
              "start": 27,
              "end": 34
            }
          }
        ]
      },
      "span": {
        "start": 22,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}

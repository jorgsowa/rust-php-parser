===source===
<?php (int)$x = 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 16,
                        "end": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 17
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}

===source===
<?php @$x = 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 7,
                      "end": 9
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 12,
                      "end": 13
                    }
                  }
                }
              },
              "span": {
                "start": 7,
                "end": 13
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}

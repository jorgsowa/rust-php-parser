===source===
<?php !$a = true;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BooleanNot",
              "operand": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 12,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}

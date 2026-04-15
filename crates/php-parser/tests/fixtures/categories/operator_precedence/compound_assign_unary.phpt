===source===
<?php -$x += 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "Negate",
              "operand": {
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
                    "op": "Plus",
                    "value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}

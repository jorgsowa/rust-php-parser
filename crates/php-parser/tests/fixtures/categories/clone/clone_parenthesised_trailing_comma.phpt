===config===
min_php=8.5
===source===
<?php $copy = clone($obj, );
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
                  "Variable": "copy"
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "Variable": "obj"
                    },
                    "span": {
                      "start": 20,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}

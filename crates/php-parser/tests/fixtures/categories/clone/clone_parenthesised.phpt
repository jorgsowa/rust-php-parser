===source===
<?php $copy = clone($obj);
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
                  "end": 11,
                  "start_line": 1,
                  "start_col": 6
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
                      "end": 24,
                      "start_line": 1,
                      "start_col": 20
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26,
    "start_line": 1,
    "start_col": 0
  }
}

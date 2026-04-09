===source===
<?php while (true):
    echo 1;
} endwhile;
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 13,
              "end": 17,
              "start_line": 1,
              "start_col": 13
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 29,
                          "end": 30,
                          "start_line": 2,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 24,
                    "end": 32,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                {
                  "kind": "Error",
                  "span": {
                    "start": 32,
                    "end": 32,
                    "start_line": 3,
                    "start_col": 0
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 43,
              "start_line": 1,
              "start_col": 6
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43,
    "start_line": 1,
    "start_col": 0
  }
}

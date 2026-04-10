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
              "end": 17
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
                          "end": 30
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 24,
                    "end": 31
                  }
                },
                {
                  "kind": "Error",
                  "span": {
                    "start": 32,
                    "end": 31
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 43
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}

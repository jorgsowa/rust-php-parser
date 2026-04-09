===source===
<?php

echo match (1) {
    0 => 'Foo',
    1 => 'Bar',
};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Match": {
                "subject": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 19,
                    "end": 20,
                    "start_line": 3,
                    "start_col": 12
                  }
                },
                "arms": [
                  {
                    "conditions": [
                      {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 28,
                          "end": 29,
                          "start_line": 4,
                          "start_col": 4
                        }
                      }
                    ],
                    "body": {
                      "kind": {
                        "String": "Foo"
                      },
                      "span": {
                        "start": 33,
                        "end": 38,
                        "start_line": 4,
                        "start_col": 9
                      }
                    },
                    "span": {
                      "start": 28,
                      "end": 38,
                      "start_line": 4,
                      "start_col": 4
                    }
                  },
                  {
                    "conditions": [
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 44,
                          "end": 45,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    ],
                    "body": {
                      "kind": {
                        "String": "Bar"
                      },
                      "span": {
                        "start": 49,
                        "end": 54,
                        "start_line": 5,
                        "start_col": 9
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 54,
                      "start_line": 5,
                      "start_col": 4
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 12,
              "end": 57,
              "start_line": 3,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 58,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58,
    "start_line": 1,
    "start_col": 0
  }
}

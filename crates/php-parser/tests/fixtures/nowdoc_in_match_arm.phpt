===source===
<?php
$r = match(true) {
    default => <<<'NOW'
    literal
    NOW,
};
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
                  "Variable": "r"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 17,
                        "end": 21,
                        "start_line": 2,
                        "start_col": 11
                      }
                    },
                    "arms": [
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Nowdoc": {
                              "label": "NOW",
                              "value": "literal"
                            }
                          },
                          "span": {
                            "start": 40,
                            "end": 68,
                            "start_line": 3,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 29,
                          "end": 68,
                          "start_line": 3,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 71,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 71,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 72,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72,
    "start_line": 1,
    "start_col": 0
  }
}

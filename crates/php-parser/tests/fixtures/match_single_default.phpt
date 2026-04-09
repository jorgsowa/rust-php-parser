===source===
<?php $x = match (true) { default => 'always' };
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
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
                        "start": 18,
                        "end": 22,
                        "start_line": 1,
                        "start_col": 18
                      }
                    },
                    "arms": [
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "always"
                          },
                          "span": {
                            "start": 37,
                            "end": 45,
                            "start_line": 1,
                            "start_col": 37
                          }
                        },
                        "span": {
                          "start": 26,
                          "end": 45,
                          "start_line": 1,
                          "start_col": 26
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 47,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 47,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}

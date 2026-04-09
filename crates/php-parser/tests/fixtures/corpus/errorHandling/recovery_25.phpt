===source===
<?php
$a = ["a "thing"];
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
                  "Variable": "a"
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "String": "a "
                        },
                        "span": {
                          "start": 12,
                          "end": 16,
                          "start_line": 2,
                          "start_col": 6
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 16,
                        "start_line": 2,
                        "start_col": 6
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 16,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "thing"
          },
          "span": {
            "start": 16,
            "end": 21,
            "start_line": 2,
            "start_col": 10
          }
        }
      },
      "span": {
        "start": 16,
        "end": 22,
        "start_line": 2,
        "start_col": 10
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 22,
        "end": 24,
        "start_line": 2,
        "start_col": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}

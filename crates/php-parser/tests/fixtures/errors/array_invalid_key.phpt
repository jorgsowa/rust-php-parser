===source===
<?php $a = [=> 'value'];
===errors===
expected expression
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
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": "Error",
                        "span": {
                          "start": 12,
                          "end": 14,
                          "start_line": 1,
                          "start_col": 12
                        }
                      },
                      "value": {
                        "kind": {
                          "String": "value"
                        },
                        "span": {
                          "start": 15,
                          "end": 22,
                          "start_line": 1,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 22,
                        "start_line": 1,
                        "start_col": 12
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 1,
        "start_col": 6
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

===source===
<?php
$arr = [
    'key' => <<<EOT
    value
    EOT,
];
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
                  "Variable": "arr"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "key"
                        },
                        "span": {
                          "start": 19,
                          "end": 24,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "value": {
                        "kind": {
                          "Heredoc": {
                            "label": "EOT",
                            "parts": [
                              {
                                "Literal": "value"
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 52,
                          "start_line": 3,
                          "start_col": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 19,
                        "end": 52,
                        "start_line": 3,
                        "start_col": 4
                      }
                    }
                  ]
                },
                "span": {
                  "start": 13,
                  "end": 55,
                  "start_line": 2,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 55,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 56,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56,
    "start_line": 1,
    "start_col": 0
  }
}

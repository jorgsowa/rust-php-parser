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
                  "end": 10
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
                          "end": 24
                        }
                      },
                      "kind": {
                        "Value": {
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
                            "end": 52
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 52
                      }
                    }
                  ]
                },
                "span": {
                  "start": 13,
                  "end": 55
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 55
          }
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}

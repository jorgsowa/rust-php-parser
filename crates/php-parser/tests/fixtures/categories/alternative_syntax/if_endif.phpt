===source===
<?php if ($x): echo 1; elseif ($y): echo 2; else: echo 3; endif;
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 10,
              "end": 12,
              "start_line": 1,
              "start_col": 10
            }
          },
          "then_branch": {
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
                          "start": 20,
                          "end": 21,
                          "start_line": 1,
                          "start_col": 20
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 15,
                    "end": 23,
                    "start_line": 1,
                    "start_col": 15
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 23,
              "start_line": 1,
              "start_col": 6
            }
          },
          "elseif_branches": [
            {
              "condition": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 31,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 31
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
                              "Int": 2
                            },
                            "span": {
                              "start": 41,
                              "end": 42,
                              "start_line": 1,
                              "start_col": 41
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 36,
                        "end": 44,
                        "start_line": 1,
                        "start_col": 36
                      }
                    }
                  ]
                },
                "span": {
                  "start": 30,
                  "end": 44,
                  "start_line": 1,
                  "start_col": 30
                }
              },
              "span": {
                "start": 30,
                "end": 44,
                "start_line": 1,
                "start_col": 30
              }
            }
          ],
          "else_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 55,
                          "end": 56,
                          "start_line": 1,
                          "start_col": 55
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 50,
                    "end": 58,
                    "start_line": 1,
                    "start_col": 50
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 58,
              "start_line": 1,
              "start_col": 6
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 64,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64,
    "start_line": 1,
    "start_col": 0
  }
}

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
              "end": 12
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
                          "end": 21
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 15,
                    "end": 22
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 22
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
                  "end": 33
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
                              "end": 42
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 36,
                        "end": 43
                      }
                    }
                  ]
                },
                "span": {
                  "start": 30,
                  "end": 43
                }
              },
              "span": {
                "start": 30,
                "end": 43
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
                          "end": 56
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 50,
                    "end": 57
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 57
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}

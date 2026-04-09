===source===
<?php if ($a) { if ($b) { echo 1; } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
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
                    "If": {
                      "condition": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 20,
                          "end": 22,
                          "start_line": 1,
                          "start_col": 20
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
                                      "start": 31,
                                      "end": 32,
                                      "start_line": 1,
                                      "start_col": 31
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 26,
                                "end": 34,
                                "start_line": 1,
                                "start_col": 26
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 24,
                          "end": 35,
                          "start_line": 1,
                          "start_col": 24
                        }
                      },
                      "elseif_branches": [],
                      "else_branch": null
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 35,
                    "start_line": 1,
                    "start_col": 16
                  }
                }
              ]
            },
            "span": {
              "start": 14,
              "end": 37,
              "start_line": 1,
              "start_col": 14
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 37,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php
if ($cond) {
    ?><p>html</p><?php
    $x = 1;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "cond"
            },
            "span": {
              "start": 10,
              "end": 15,
              "start_line": 2,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "InlineHtml": "<p>html</p>"
                  },
                  "span": {
                    "start": 25,
                    "end": 36,
                    "start_line": 3,
                    "start_col": 6
                  }
                },
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
                              "start": 46,
                              "end": 48,
                              "start_line": 4,
                              "start_col": 4
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 51,
                              "end": 52,
                              "start_line": 4,
                              "start_col": 9
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 46,
                        "end": 52,
                        "start_line": 4,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 54,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 17,
              "end": 55,
              "start_line": 2,
              "start_col": 11
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 55,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55,
    "start_line": 1,
    "start_col": 0
  }
}

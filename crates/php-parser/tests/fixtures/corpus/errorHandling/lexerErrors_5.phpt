===source===
<?php

if ($b) {
    $a = 1;
    /* unterminated
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 11,
              "end": 13,
              "start_line": 3,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
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
                              "start": 21,
                              "end": 23,
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
                              "start": 26,
                              "end": 27,
                              "start_line": 4,
                              "start_col": 9
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 27,
                        "start_line": 4,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 50,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 15,
              "end": 50,
              "start_line": 3,
              "start_col": 8
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 7,
        "end": 50,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50,
    "start_line": 1,
    "start_col": 0
  }
}

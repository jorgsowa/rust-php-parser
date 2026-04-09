===source===
<?php function f() { if () { return 1; } return 2; }
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [
            {
              "kind": {
                "If": {
                  "condition": {
                    "kind": "Error",
                    "span": {
                      "start": 25,
                      "end": 26,
                      "start_line": 1,
                      "start_col": 25
                    }
                  },
                  "then_branch": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "Return": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 36,
                                "end": 37,
                                "start_line": 1,
                                "start_col": 36
                              }
                            }
                          },
                          "span": {
                            "start": 29,
                            "end": 39,
                            "start_line": 1,
                            "start_col": 29
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 27,
                      "end": 40,
                      "start_line": 1,
                      "start_col": 27
                    }
                  },
                  "elseif_branches": [],
                  "else_branch": null
                }
              },
              "span": {
                "start": 21,
                "end": 40,
                "start_line": 1,
                "start_col": 21
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 2
                  },
                  "span": {
                    "start": 48,
                    "end": 49,
                    "start_line": 1,
                    "start_col": 48
                  }
                }
              },
              "span": {
                "start": 41,
                "end": 51,
                "start_line": 1,
                "start_col": 41
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php foreach ($items as &$item) { $item *= 2; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "items"
            },
            "span": {
              "start": 15,
              "end": 21,
              "start_line": 1,
              "start_col": 15
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "item"
            },
            "span": {
              "start": 26,
              "end": 31,
              "start_line": 1,
              "start_col": 26
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "item"
                            },
                            "span": {
                              "start": 35,
                              "end": 40,
                              "start_line": 1,
                              "start_col": 35
                            }
                          },
                          "op": "Mul",
                          "value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 44,
                              "end": 45,
                              "start_line": 1,
                              "start_col": 44
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 35,
                        "end": 45,
                        "start_line": 1,
                        "start_col": 35
                      }
                    }
                  },
                  "span": {
                    "start": 35,
                    "end": 47,
                    "start_line": 1,
                    "start_col": 35
                  }
                }
              ]
            },
            "span": {
              "start": 33,
              "end": 48,
              "start_line": 1,
              "start_col": 33
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}

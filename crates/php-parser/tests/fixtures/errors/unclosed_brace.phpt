===source===
<?php if (true) { $x = 1;
===errors===
unclosed ''}'' opened at Span { start: 16, end: 17 }
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 10,
              "end": 14
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
                              "Variable": "x"
                            },
                            "span": {
                              "start": 18,
                              "end": 20
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 23,
                              "end": 24
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 24
                      }
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 25
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 25
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}

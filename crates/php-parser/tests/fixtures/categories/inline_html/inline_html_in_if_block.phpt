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
              "end": 15
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
                    "end": 36
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
                              "end": 48
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 51,
                              "end": 52
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 46,
                        "end": 52
                      }
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 53
                  }
                }
              ]
            },
            "span": {
              "start": 17,
              "end": 55
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}

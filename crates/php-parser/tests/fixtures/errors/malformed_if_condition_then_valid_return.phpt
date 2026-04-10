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
                      "end": 26
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
                                "end": 37
                              }
                            }
                          },
                          "span": {
                            "start": 29,
                            "end": 38
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 27,
                      "end": 40
                    }
                  },
                  "elseif_branches": [],
                  "else_branch": null
                }
              },
              "span": {
                "start": 21,
                "end": 40
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
                    "end": 49
                  }
                }
              },
              "span": {
                "start": 41,
                "end": 50
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
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}

===source===
<?php list($a, , $c) = $arr;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 11,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 15,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 16
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 17,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 20
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 23,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}

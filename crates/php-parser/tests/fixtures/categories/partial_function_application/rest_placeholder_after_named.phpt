===config===
min_php=8.6
===source===
<?php $fn = stuff(1, a: 5, ...);
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "stuff"
                      },
                      "span": {
                        "start": 12,
                        "end": 17
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 18,
                            "end": 19
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 18,
                          "end": 19
                        }
                      },
                      {
                        "name": {
                          "parts": [
                            "a"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 21,
                            "end": 22
                          }
                        },
                        "value": {
                          "kind": {
                            "Int": 5
                          },
                          "span": {
                            "start": 24,
                            "end": 25
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 21,
                          "end": 25
                        }
                      },
                      {
                        "name": null,
                        "value": null,
                        "unpack": true,
                        "by_ref": false,
                        "span": {
                          "start": 27,
                          "end": 30
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}

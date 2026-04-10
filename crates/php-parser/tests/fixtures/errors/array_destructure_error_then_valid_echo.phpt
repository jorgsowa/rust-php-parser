===source===
<?php [$a, , ,] = ; echo $a;
===errors===
expected expression
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
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 7,
                          "end": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 11,
                          "end": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 13,
                          "end": 14
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": "Error",
                "span": {
                  "start": 18,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 25,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 20,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}

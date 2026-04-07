===source===
<?php [0 => $first, 'key' => $val] = $arr;
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
                      "key": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 7,
                          "end": 8
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "first"
                        },
                        "span": {
                          "start": 12,
                          "end": 18
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 18
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "key"
                        },
                        "span": {
                          "start": 20,
                          "end": 25
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "val"
                        },
                        "span": {
                          "start": 29,
                          "end": 33
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 20,
                        "end": 33
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 34
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 37,
                  "end": 41
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 41
          }
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}

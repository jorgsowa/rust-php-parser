===source===
<?php foreach ($arr as [$key, $value]) { echo $key; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "arr"
            },
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "key"
                      },
                      "span": {
                        "start": 24,
                        "end": 28
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 28
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "value"
                      },
                      "span": {
                        "start": 30,
                        "end": 36
                      }
                    }
                  },
                  "span": {
                    "start": 30,
                    "end": 36
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 37
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "key"
                        },
                        "span": {
                          "start": 46,
                          "end": 50
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 41,
                    "end": 51
                  }
                }
              ]
            },
            "span": {
              "start": 39,
              "end": 53
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}

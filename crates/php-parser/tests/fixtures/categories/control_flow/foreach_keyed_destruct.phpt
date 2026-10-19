===source===
<?php foreach ($arr as $k => [$a, $b]) {}
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
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 23,
              "end": 25
            }
          },
          "value": {
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
                        "start": 30,
                        "end": 32
                      }
                    }
                  },
                  "span": {
                    "start": 30,
                    "end": 32
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 34,
                        "end": 36
                      }
                    }
                  },
                  "span": {
                    "start": 34,
                    "end": 36
                  }
                }
              ]
            },
            "span": {
              "start": 29,
              "end": 37
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 39,
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
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}

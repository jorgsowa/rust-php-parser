===source===
<?php $a = clone $b = $c;
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 17,
                            "end": 19
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 22,
                            "end": 24
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 17,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
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

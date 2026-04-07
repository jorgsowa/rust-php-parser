===source===
<?php [...$a, ...$b, 1, 2];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 10,
                    "end": 12
                  }
                },
                "unpack": true,
                "span": {
                  "start": 7,
                  "end": 12
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Variable": "b"
                  },
                  "span": {
                    "start": 17,
                    "end": 19
                  }
                },
                "unpack": true,
                "span": {
                  "start": 14,
                  "end": 19
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 21,
                    "end": 22
                  }
                },
                "unpack": false,
                "span": {
                  "start": 21,
                  "end": 22
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 2
                  },
                  "span": {
                    "start": 24,
                    "end": 25
                  }
                },
                "unpack": false,
                "span": {
                  "start": 24,
                  "end": 25
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}

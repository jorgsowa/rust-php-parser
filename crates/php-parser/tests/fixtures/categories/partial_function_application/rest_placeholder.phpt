===config===
min_php=8.6
===source===
<?php $fn = foo(1, ...);
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
                        "Identifier": "foo"
                      },
                      "span": {
                        "start": 12,
                        "end": 15
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
                            "start": 16,
                            "end": 17
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 16,
                          "end": 17
                        }
                      },
                      {
                        "name": null,
                        "value": null,
                        "unpack": true,
                        "by_ref": false,
                        "span": {
                          "start": 19,
                          "end": 22
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}

===config===
min_php=8.6
===source===
<?php $fn = foo(s: ?, i: ?);
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
                        "name": {
                          "parts": [
                            "s"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        },
                        "value": null,
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 16,
                          "end": 20
                        }
                      },
                      {
                        "name": {
                          "parts": [
                            "i"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 22,
                            "end": 23
                          }
                        },
                        "value": null,
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 22,
                          "end": 26
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
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

===config===
min_php=8.6
===source===
<?php $fn = foo(?);
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
                        "value": null,
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 16,
                          "end": 17
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}

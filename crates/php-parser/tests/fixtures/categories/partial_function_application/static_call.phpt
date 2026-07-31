===config===
min_php=8.6
===source===
<?php $fn = Foo::bar(?);
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
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "bar"
                      },
                      "span": {
                        "start": 17,
                        "end": 20
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": null,
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 21,
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

===config===
min_php=8.1
===source===
<?php $val = Fiber::suspend(42);
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
                  "Variable": "val"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Identifier": "Fiber"
                      },
                      "span": {
                        "start": 13,
                        "end": 18
                      }
                    },
                    "method": "suspend",
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 42
                          },
                          "span": {
                            "start": 28,
                            "end": 30
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 28,
                          "end": 30
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 13,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}

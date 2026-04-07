===source===
<?php foo(1, 2, name: 'test', other: true);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 9
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
                      "start": 10,
                      "end": 11
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 11
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 13,
                      "end": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 13,
                    "end": 14
                  }
                },
                {
                  "name": "name",
                  "value": {
                    "kind": {
                      "String": "test"
                    },
                    "span": {
                      "start": 22,
                      "end": 28
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 28
                  }
                },
                {
                  "name": "other",
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 37,
                      "end": 41
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 30,
                    "end": 41
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 42
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}

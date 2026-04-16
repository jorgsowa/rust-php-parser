===source===
<?php new Foo(x: 1, y: 2);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 14,
                      "end": 15
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 17,
                      "end": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 18
                  }
                },
                {
                  "name": {
                    "name": "y",
                    "span": {
                      "start": 20,
                      "end": 21
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 23,
                      "end": 24
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 24
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}

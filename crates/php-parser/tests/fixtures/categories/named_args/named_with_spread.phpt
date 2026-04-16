===source===
<?php foo(...$extra, name: 'test');
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
                      "Variable": "extra"
                    },
                    "span": {
                      "start": 13,
                      "end": 19
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 19
                  }
                },
                {
                  "name": {
                    "name": "name",
                    "span": {
                      "start": 21,
                      "end": 25
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "test"
                    },
                    "span": {
                      "start": 27,
                      "end": 33
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 33
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}

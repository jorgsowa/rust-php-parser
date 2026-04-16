===source===
<?php func(...$args, last: 'end');
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
                  "Identifier": "func"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "args"
                    },
                    "span": {
                      "start": 14,
                      "end": 19
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 19
                  }
                },
                {
                  "name": {
                    "parts": [
                      "last"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 25
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "end"
                    },
                    "span": {
                      "start": 27,
                      "end": 32
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 32
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}

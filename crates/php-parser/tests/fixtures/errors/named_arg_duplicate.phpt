===source===
<?php func(a: 1, a: 2);
===errors===
named argument 'a' overwrites previous argument
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
                  "name": "a",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 14,
                      "end": 15
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 15
                  }
                },
                {
                  "name": "a",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 20,
                      "end": 21
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 17,
                    "end": 21
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}

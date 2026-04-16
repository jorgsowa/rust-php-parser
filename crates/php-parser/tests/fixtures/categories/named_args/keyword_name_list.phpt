===source===
<?php foo(list: $x);
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
                  "name": {
                    "parts": [
                      "list"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 14
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 16,
                      "end": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}

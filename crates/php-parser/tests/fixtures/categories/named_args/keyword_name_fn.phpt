===source===
<?php foo(fn: $x);
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
                      "fn"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 12
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 14,
                      "end": 16
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 16
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}

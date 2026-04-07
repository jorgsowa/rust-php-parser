===source===
<?php foo()->bar();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
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
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "method": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 13,
                  "end": 16
                }
              },
              "args": []
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

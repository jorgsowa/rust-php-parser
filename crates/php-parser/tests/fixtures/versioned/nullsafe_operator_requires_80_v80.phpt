===config===
min_php=8.0
===source===
<?php $result = $obj?->method();
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
                  "Variable": "result"
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullsafeMethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 16,
                        "end": 20
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method"
                      },
                      "span": {
                        "start": 23,
                        "end": 29
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 16,
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

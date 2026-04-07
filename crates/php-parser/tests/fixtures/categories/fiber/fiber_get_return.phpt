===config===
min_php=8.1
===source===
<?php $result = $fiber->getReturn();
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
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "fiber"
                      },
                      "span": {
                        "start": 16,
                        "end": 22
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "getReturn"
                      },
                      "span": {
                        "start": 24,
                        "end": 33
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 16,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}

===description===
PHP: `10 ** $this->getCount()` is `10 ** ($this->getCount())`. Method call binds tighter than `**`.
===source===
<?php
10 ** $this->getCount();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Int": 10
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "this"
                      },
                      "span": {
                        "start": 12,
                        "end": 17
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "getCount"
                      },
                      "span": {
                        "start": 19,
                        "end": 27
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}

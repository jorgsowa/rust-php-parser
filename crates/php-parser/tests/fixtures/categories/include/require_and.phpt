===source===
<?php
require $a and $b;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Require",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 14,
                        "end": 16
                      }
                    },
                    "op": "LogicalAnd",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 21,
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 23
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}

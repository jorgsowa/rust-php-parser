===source===
<?php
include_once $a xor $b;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "IncludeOnce",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 19,
                        "end": 21
                      }
                    },
                    "op": "LogicalXor",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 26,
                        "end": 28
                      }
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 28
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}

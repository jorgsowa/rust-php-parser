===source===
<?php
throw $e xor 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Throw": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              },
              "op": "LogicalXor",
              "right": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 19,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 12,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}

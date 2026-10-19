===source===
<?php
try {} catch (int\X | float\Y $e) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "int",
                    "X"
                  ],
                  "kind": "Qualified",
                  "span": {
                    "start": 20,
                    "end": 25
                  }
                },
                {
                  "parts": [
                    "float",
                    "Y"
                  ],
                  "kind": "Qualified",
                  "span": {
                    "start": 28,
                    "end": 35
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 36,
                  "end": 38
                }
              },
              "body": [],
              "span": {
                "start": 19,
                "end": 42
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}

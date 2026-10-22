===source===
<?php
parent:
__construct();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Label": {
          "name": "parent",
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "__construct"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 14,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 25
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 14,
            "end": 27
          }
        }
      },
      "span": {
        "start": 14,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}

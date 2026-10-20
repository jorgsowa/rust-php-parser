===source===
<?php
use A as enum;
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "alias": {
                "name": "enum",
                "span": {
                  "start": 15,
                  "end": 19
                }
              },
              "span": {
                "start": 10,
                "end": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}

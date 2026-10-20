===source===
<?php
self: $x;
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Label": {
          "name": "self",
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "x"
          },
          "span": {
            "start": 12,
            "end": 14
          }
        }
      },
      "span": {
        "start": 12,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}

===source===
<?php const A = 1, B = 2, C = 3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "A",
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 16,
                "end": 17
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 17
            }
          },
          {
            "name": "B",
            "value": {
              "kind": {
                "Int": 2
              },
              "span": {
                "start": 23,
                "end": 24
              }
            },
            "attributes": [],
            "span": {
              "start": 19,
              "end": 24
            }
          },
          {
            "name": "C",
            "value": {
              "kind": {
                "Int": 3
              },
              "span": {
                "start": 30,
                "end": 31
              }
            },
            "attributes": [],
            "span": {
              "start": 26,
              "end": 31
            }
          }
        ]
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

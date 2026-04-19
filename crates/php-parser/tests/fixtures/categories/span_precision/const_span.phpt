===source===
<?php
const FOO = 1;
const A = 1, B = 2;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "FOO",
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 18,
                "end": 19
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 19
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
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
                "start": 31,
                "end": 32
              }
            },
            "attributes": [],
            "span": {
              "start": 27,
              "end": 32
            }
          },
          {
            "name": "B",
            "value": {
              "kind": {
                "Int": 2
              },
              "span": {
                "start": 38,
                "end": 39
              }
            },
            "attributes": [],
            "span": {
              "start": 34,
              "end": 39
            }
          }
        ]
      },
      "span": {
        "start": 21,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}

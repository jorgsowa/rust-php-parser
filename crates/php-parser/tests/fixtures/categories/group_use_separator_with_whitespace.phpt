===source===
<?php
use Foo \ {A};
use Bar\ {B};
===ast===
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
                  "Foo",
                  "A"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 18
                }
              },
              "alias": null,
              "span": {
                "start": 17,
                "end": 18
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Bar",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 25,
                  "end": 32
                }
              },
              "alias": null,
              "span": {
                "start": 31,
                "end": 32
              }
            }
          ]
        }
      },
      "span": {
        "start": 21,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}

===source===
<?php
const self = 1, Parent = 2;
echo self, PARENT;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "self",
              "span": {
                "start": 12,
                "end": 16
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 19,
                "end": 20
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 20
            }
          },
          {
            "name": {
              "name": "Parent",
              "span": {
                "start": 22,
                "end": 28
              }
            },
            "value": {
              "kind": {
                "Int": 2
              },
              "span": {
                "start": 31,
                "end": 32
              }
            },
            "attributes": [],
            "span": {
              "start": 22,
              "end": 32
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 33
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Name": {
                "parts": [
                  "self"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 39,
                  "end": 43
                }
              }
            },
            "span": {
              "start": 39,
              "end": 43
            }
          },
          {
            "kind": {
              "Name": {
                "parts": [
                  "parent"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 45,
                  "end": 51
                }
              }
            },
            "span": {
              "start": 45,
              "end": 51
            }
          }
        ]
      },
      "span": {
        "start": 34,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}

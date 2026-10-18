===source===
<?php

/* block comment */
const BLOCK = 1;

// line comment
const LINE = 2;

# hash comment
const HASH = 3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "BLOCK",
              "span": {
                "start": 33,
                "end": 38
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 41,
                "end": 42
              }
            },
            "attributes": [],
            "span": {
              "start": 33,
              "end": 42
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 43
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "LINE",
              "span": {
                "start": 67,
                "end": 71
              }
            },
            "value": {
              "kind": {
                "Int": 2
              },
              "span": {
                "start": 74,
                "end": 75
              }
            },
            "attributes": [],
            "span": {
              "start": 67,
              "end": 75
            }
          }
        ]
      },
      "span": {
        "start": 61,
        "end": 76
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "HASH",
              "span": {
                "start": 99,
                "end": 103
              }
            },
            "value": {
              "kind": {
                "Int": 3
              },
              "span": {
                "start": 106,
                "end": 107
              }
            },
            "attributes": [],
            "span": {
              "start": 99,
              "end": 107
            }
          }
        ]
      },
      "span": {
        "start": 93,
        "end": 108
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 108
  }
}

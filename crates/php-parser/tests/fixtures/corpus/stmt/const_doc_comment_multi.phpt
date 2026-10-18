===source===
<?php

/** Only for FIRST */
const FIRST = 1, SECOND = 2, THIRD = 3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "FIRST",
              "span": {
                "start": 35,
                "end": 40
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 43,
                "end": 44
              }
            },
            "attributes": [],
            "span": {
              "start": 35,
              "end": 44
            },
            "doc_comment": {
              "kind": "Doc",
              "text": "/** Only for FIRST */",
              "span": {
                "start": 7,
                "end": 28
              }
            }
          },
          {
            "name": {
              "name": "SECOND",
              "span": {
                "start": 46,
                "end": 52
              }
            },
            "value": {
              "kind": {
                "Int": 2
              },
              "span": {
                "start": 55,
                "end": 56
              }
            },
            "attributes": [],
            "span": {
              "start": 46,
              "end": 56
            }
          },
          {
            "name": {
              "name": "THIRD",
              "span": {
                "start": 58,
                "end": 63
              }
            },
            "value": {
              "kind": {
                "Int": 3
              },
              "span": {
                "start": 66,
                "end": 67
              }
            },
            "attributes": [],
            "span": {
              "start": 58,
              "end": 67
            }
          }
        ]
      },
      "span": {
        "start": 29,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}

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
            "name": "FIRST",
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
            "name": "SECOND",
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
            "name": "THIRD",
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

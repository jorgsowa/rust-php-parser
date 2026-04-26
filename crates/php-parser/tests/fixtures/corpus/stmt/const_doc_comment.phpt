===source===
<?php

/** The answer to everything */
const ANSWER = 42;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "ANSWER",
            "value": {
              "kind": {
                "Int": 42
              },
              "span": {
                "start": 54,
                "end": 56
              }
            },
            "attributes": [],
            "span": {
              "start": 45,
              "end": 56
            },
            "doc_comment": {
              "kind": "Doc",
              "text": "/** The answer to everything */",
              "span": {
                "start": 7,
                "end": 38
              }
            }
          }
        ]
      },
      "span": {
        "start": 39,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}

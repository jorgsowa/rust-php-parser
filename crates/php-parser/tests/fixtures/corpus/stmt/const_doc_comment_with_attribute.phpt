===config===
min_php=8.5
===source===
<?php

/** @api */
#[SomeAttribute]
const VERSION = '1.0.0';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "VERSION",
            "value": {
              "kind": {
                "String": "1.0.0"
              },
              "span": {
                "start": 52,
                "end": 59
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "SomeAttribute"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 21,
                    "end": 34
                  }
                },
                "args": [],
                "span": {
                  "start": 21,
                  "end": 34
                }
              }
            ],
            "span": {
              "start": 42,
              "end": 59
            },
            "doc_comment": {
              "kind": "Doc",
              "text": "/** @api */",
              "span": {
                "start": 7,
                "end": 18
              }
            }
          }
        ]
      },
      "span": {
        "start": 36,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}

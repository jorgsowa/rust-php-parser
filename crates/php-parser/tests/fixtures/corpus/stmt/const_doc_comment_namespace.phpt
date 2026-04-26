===source===
<?php

namespace App\Config;

/** Maximum retry count */
const MAX_RETRIES = 3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "App",
              "Config"
            ],
            "kind": "Qualified",
            "span": {
              "start": 17,
              "end": 27
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 7,
        "end": 28
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "MAX_RETRIES",
            "value": {
              "kind": {
                "Int": 3
              },
              "span": {
                "start": 77,
                "end": 78
              }
            },
            "attributes": [],
            "span": {
              "start": 63,
              "end": 78
            },
            "doc_comment": {
              "kind": "Doc",
              "text": "/** Maximum retry count */",
              "span": {
                "start": 30,
                "end": 56
              }
            }
          }
        ]
      },
      "span": {
        "start": 57,
        "end": 79
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79
  }
}

===source===
<?php namespace Foo;
use Throwable;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Foo"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "body": "Simple"
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
                  "Throwable"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 25,
                  "end": 34
                }
              },
              "alias": null,
              "span": {
                "start": 25,
                "end": 34
              }
            }
          ]
        }
      },
      "span": {
        "start": 21,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}

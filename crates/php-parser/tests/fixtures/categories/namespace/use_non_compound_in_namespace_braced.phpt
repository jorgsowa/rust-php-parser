===source===
<?php namespace Foo {
use Throwable;
}
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
          "body": {
            "Braced": [
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
                            "start": 26,
                            "end": 35
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 26,
                          "end": 35
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 22,
                  "end": 36
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}

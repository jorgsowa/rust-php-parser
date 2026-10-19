===config===
ignore=non-fatal warning: use with a non-compound name
===source===
<?php namespace {
use Throwable;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": null,
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
                            "start": 22,
                            "end": 31
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 22,
                          "end": 31
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 18,
                  "end": 32
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}

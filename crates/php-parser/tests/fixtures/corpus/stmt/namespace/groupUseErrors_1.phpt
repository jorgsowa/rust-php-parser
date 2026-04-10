===source===
<?php
// Missing semicolon
use Foo\{Bar}
use Bar\{Foo};
===errors===
expected ';', found 'use'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 31,
                  "end": 39
                }
              },
              "alias": null,
              "span": {
                "start": 36,
                "end": 39
              }
            }
          ]
        }
      },
      "span": {
        "start": 27,
        "end": 41
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
                  "Bar",
                  "Foo"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 45,
                  "end": 53
                }
              },
              "alias": null,
              "span": {
                "start": 50,
                "end": 53
              }
            }
          ]
        }
      },
      "span": {
        "start": 41,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}

===config===
ignore=non-fatal warning: unsupported declare directive
===source===
<?php
declare(foo=1, Bar='x');
declare(ticks=1, baz=2) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "foo",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 18,
                  "end": 19
                }
              }
            ],
            [
              "Bar",
              {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 25,
                  "end": 28
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 45,
                  "end": 46
                }
              }
            ],
            [
              "baz",
              {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 52,
                  "end": 53
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 55,
              "end": 57
            }
          }
        }
      },
      "span": {
        "start": 31,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}

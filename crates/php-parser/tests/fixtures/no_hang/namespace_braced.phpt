===source===
<?php namespace Foo { ?> <?php }
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
              "end": 20
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "InlineHtml": " "
                },
                "span": {
                  "start": 24,
                  "end": 25
                }
              },
              {
                "kind": "Nop",
                "span": {
                  "start": 31,
                  "end": 32
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}

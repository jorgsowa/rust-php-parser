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
              "end": 20,
              "start_line": 1,
              "start_col": 16
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
                  "end": 25,
                  "start_line": 1,
                  "start_col": 24
                }
              },
              {
                "kind": "Nop",
                "span": {
                  "start": 31,
                  "end": 32,
                  "start_line": 1,
                  "start_col": 31
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32,
    "start_line": 1,
    "start_col": 0
  }
}

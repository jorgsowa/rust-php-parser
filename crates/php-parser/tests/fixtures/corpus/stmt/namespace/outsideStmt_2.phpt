===source===
<?php
/* Comment */
;
namespace Foo;
===ast===
{
  "stmts": [
    {
      "kind": "Nop",
      "span": {
        "start": 20,
        "end": 21
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Foo"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 32,
              "end": 35
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 22,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}

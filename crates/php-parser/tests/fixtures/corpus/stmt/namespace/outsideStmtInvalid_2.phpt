===config===
php_rejects=semantic
===source===
<?php
namespace A {}
echo 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": []
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 26,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 21,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
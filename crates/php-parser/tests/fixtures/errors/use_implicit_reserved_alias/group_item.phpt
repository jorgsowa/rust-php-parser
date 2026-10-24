===source===
<?php
use A\{B, self};
===errors===
Cannot use A\self as self because 'self' is a special class name
===php_error===
PHP Fatal error:  Cannot use A\self as self because 'self' is a special class name in Standard input code on line 2
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
                  "A",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 13,
                  "end": 14
                }
              },
              "alias": null,
              "span": {
                "start": 13,
                "end": 14
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "self"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 16,
                  "end": 20
                }
              },
              "alias": null,
              "span": {
                "start": 16,
                "end": 20
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}

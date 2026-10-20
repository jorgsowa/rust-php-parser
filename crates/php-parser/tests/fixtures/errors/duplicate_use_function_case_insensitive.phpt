===source===
<?php
use function A\f; use function B\F;
===errors >=8.5===
Cannot use function B\F as F because the name is already in use
===php_error===
PHP Fatal error:  Cannot use function B\F as F because the name is already in use in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "f"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 19,
                  "end": 22
                }
              },
              "alias": null,
              "span": {
                "start": 19,
                "end": 22
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "B",
                  "F"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 37,
                  "end": 40
                }
              },
              "alias": null,
              "span": {
                "start": 37,
                "end": 40
              }
            }
          ]
        }
      },
      "span": {
        "start": 24,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}

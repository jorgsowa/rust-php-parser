===source===
<?php
use A\{B}; use A\{b};
===errors >=8.5===
Cannot use A\b as b because the name is already in use
===php_error===
PHP Fatal error:  Cannot use A\b as b because the name is already in use in Standard input code on line 2
===ast >=8.5===
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
                  "start": 10,
                  "end": 14
                }
              },
              "alias": null,
              "span": {
                "start": 13,
                "end": 14
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 16
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
                  "A",
                  "b"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 21,
                  "end": 25
                }
              },
              "alias": null,
              "span": {
                "start": 24,
                "end": 25
              }
            }
          ]
        }
      },
      "span": {
        "start": 17,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}

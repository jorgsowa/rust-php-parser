===source===
<?php
use A\B; use A\b;
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
                  "end": 13
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 13
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 14
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
        "start": 15,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}

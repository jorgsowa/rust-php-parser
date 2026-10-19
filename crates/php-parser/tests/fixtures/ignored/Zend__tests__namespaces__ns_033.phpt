===config===
min_php=8.5
===source===
<?php
use A;
use \B;
?>
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
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 11
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 12
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
                  "B"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "alias": null,
              "span": {
                "start": 17,
                "end": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 13,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}

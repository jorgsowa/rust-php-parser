===source===
<?php
namespace N;
#[\DelayedTargetValidation] #[\Attribute] trait T {}
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 67,
              "end": 68
            }
          },
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 21,
                  "end": 45
                }
              },
              "args": [],
              "span": {
                "start": 21,
                "end": 45
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 49,
                  "end": 59
                }
              },
              "args": [],
              "span": {
                "start": 49,
                "end": 59
              }
            }
          ]
        }
      },
      "span": {
        "start": 61,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}

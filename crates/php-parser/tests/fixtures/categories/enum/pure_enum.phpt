===source===
<?php enum Direction { case North; case South; case East; case West; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Direction",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "North",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 35
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "South",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 35,
                "end": 47
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "East",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 58
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "West",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 58,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}

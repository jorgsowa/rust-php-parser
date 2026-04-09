===config===
min_php=8.1
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
                "end": 35,
                "start_line": 1,
                "start_col": 23
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
                "end": 47,
                "start_line": 1,
                "start_col": 35
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
                "end": 58,
                "start_line": 1,
                "start_col": 47
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
                "end": 69,
                "start_line": 1,
                "start_col": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 70,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70,
    "start_line": 1,
    "start_col": 0
  }
}

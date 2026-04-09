===config===
min_php=8.1
===source===
<?php
enum Direction implements HasLabel {
    use LabelTrait;
    case North;
    case South;
    case East;
    case West;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Direction",
          "scalar_type": null,
          "implements": [
            {
              "parts": [
                "HasLabel"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 32,
                "end": 41,
                "start_line": 2,
                "start_col": 26
              }
            }
          ],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "LabelTrait"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 51,
                        "end": 61,
                        "start_line": 3,
                        "start_col": 8
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 47,
                "end": 67,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "North",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 67,
                "end": 83,
                "start_line": 4,
                "start_col": 4
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
                "start": 83,
                "end": 99,
                "start_line": 5,
                "start_col": 4
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
                "start": 99,
                "end": 114,
                "start_line": 6,
                "start_col": 4
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
                "start": 114,
                "end": 125,
                "start_line": 7,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 126,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 126,
    "start_line": 1,
    "start_col": 0
  }
}

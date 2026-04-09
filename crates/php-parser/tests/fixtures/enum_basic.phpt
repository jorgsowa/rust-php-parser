===config===
min_php=8.1
===source===
<?php
enum Color {
    case Red;
    case Green;
    case Blue;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Color",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Red",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 37,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Green",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 53,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Blue",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 53,
                "end": 64,
                "start_line": 5,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 65,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65,
    "start_line": 1,
    "start_col": 0
  }
}

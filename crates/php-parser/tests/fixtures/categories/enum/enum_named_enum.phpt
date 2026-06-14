===config===
min_php=8.1
===source===
<?php
enum Enum {
    case A;
    case B;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Enum",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "A",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 29
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "B",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 34,
                "end": 41
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}

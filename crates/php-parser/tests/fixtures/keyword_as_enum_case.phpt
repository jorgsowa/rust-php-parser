===config===
min_php=8.1
===source===
<?php enum Suit { case for; case function; case match; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Suit",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "for",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 27
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "function",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 28,
                "end": 42
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "match",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 54
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}

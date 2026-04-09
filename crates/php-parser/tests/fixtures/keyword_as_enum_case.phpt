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
                "end": 28,
                "start_line": 1,
                "start_col": 18
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
                "end": 43,
                "start_line": 1,
                "start_col": 28
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
                "end": 55,
                "start_line": 1,
                "start_col": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56,
    "start_line": 1,
    "start_col": 0
  }
}

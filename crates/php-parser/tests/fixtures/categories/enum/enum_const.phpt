===config===
min_php=8.1
===source===
<?php enum Suit: string { const TOTAL = 4; case Hearts = 'H'; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Suit",
          "scalar_type": {
            "parts": [
              "string"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 17,
              "end": 24,
              "start_line": 1,
              "start_col": 17
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "TOTAL",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 40,
                      "end": 41,
                      "start_line": 1,
                      "start_col": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 43,
                "start_line": 1,
                "start_col": 26
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Hearts",
                  "value": {
                    "kind": {
                      "String": "H"
                    },
                    "span": {
                      "start": 57,
                      "end": 60,
                      "start_line": 1,
                      "start_col": 57
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 62,
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
        "end": 63,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}

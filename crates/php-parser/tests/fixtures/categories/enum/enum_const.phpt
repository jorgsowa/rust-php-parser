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
              "end": 24
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
                      "end": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 43
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
                      "end": 60
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 62
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}

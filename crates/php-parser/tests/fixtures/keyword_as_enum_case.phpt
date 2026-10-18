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
          "name": {
            "name": "Suit",
            "span": {
              "start": 11,
              "end": 15
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "for",
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  },
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
                  "name": {
                    "name": "function",
                    "span": {
                      "start": 33,
                      "end": 41
                    }
                  },
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
                  "name": {
                    "name": "match",
                    "span": {
                      "start": 48,
                      "end": 53
                    }
                  },
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

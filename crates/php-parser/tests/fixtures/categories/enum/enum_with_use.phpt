===config===
min_php=8.1
===source===
<?php enum Suit { use SuitTrait; case Hearts; }
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "SuitTrait"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 22,
                        "end": 31,
                        "start_line": 1,
                        "start_col": 22
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 18,
                "end": 33,
                "start_line": 1,
                "start_col": 18
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Hearts",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 46,
                "start_line": 1,
                "start_col": 33
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}

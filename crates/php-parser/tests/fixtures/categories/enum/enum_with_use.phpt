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
                        "end": 31
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 18,
                "end": 33
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
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}

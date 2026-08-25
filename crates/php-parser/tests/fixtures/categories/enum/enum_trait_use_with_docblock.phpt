===config===
min_php=8.1
===source===
<?php

enum Status
{
    /**
     * Uses shared enum behavior.
     */
    use EnumBehavior;

    case Active;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "EnumBehavior"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 79,
                        "end": 91
                      }
                    }
                  ],
                  "adaptations": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Uses shared enum behavior.\n     */",
                    "span": {
                      "start": 25,
                      "end": 70
                    }
                  }
                }
              },
              "span": {
                "start": 75,
                "end": 92
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Active",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 110
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 112
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112
  }
}

===source===
<?php

class Multi
{
    /**
     * Uses two behaviors.
     */
    use BehaviorA, BehaviorB;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Multi",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "BehaviorA"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 72,
                        "end": 81
                      }
                    },
                    {
                      "parts": [
                        "BehaviorB"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 83,
                        "end": 92
                      }
                    }
                  ],
                  "adaptations": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Uses two behaviors.\n     */",
                    "span": {
                      "start": 25,
                      "end": 63
                    }
                  }
                }
              },
              "span": {
                "start": 68,
                "end": 93
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 95
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 95
  }
}

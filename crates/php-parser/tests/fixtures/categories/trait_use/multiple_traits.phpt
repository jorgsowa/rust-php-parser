===source===
<?php class C { use A, B, C; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "C",
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
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    },
                    {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    },
                    {
                      "parts": [
                        "C"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 26,
                        "end": 27
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 16,
                "end": 29
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}

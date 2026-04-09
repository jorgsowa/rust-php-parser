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
                        "end": 21,
                        "start_line": 1,
                        "start_col": 20
                      }
                    },
                    {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 23,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 23
                      }
                    },
                    {
                      "parts": [
                        "C"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 26,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 26
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 16,
                "end": 29,
                "start_line": 1,
                "start_col": 16
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30,
    "start_line": 1,
    "start_col": 0
  }
}

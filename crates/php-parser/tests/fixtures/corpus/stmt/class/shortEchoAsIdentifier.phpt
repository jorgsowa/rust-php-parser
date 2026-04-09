===source===
<?php
class C {
    use T {
        x as y?><?= as my_echo;
    }
}
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
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 26,
                        "start_line": 3,
                        "start_col": 8
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": "x",
                          "new_modifier": null,
                          "new_name": "y"
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 42,
                        "start_line": 4,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 66,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67,
    "start_line": 1,
    "start_col": 0
  }
}

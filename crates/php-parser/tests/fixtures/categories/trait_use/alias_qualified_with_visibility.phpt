===source===
<?php class C { use T { T::foo as protected baz; } }
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
                        "start": 20,
                        "end": 22,
                        "start_line": 1,
                        "start_col": 20
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 24,
                              "end": 25,
                              "start_line": 1,
                              "start_col": 24
                            }
                          },
                          "method": "foo",
                          "new_modifier": "Protected",
                          "new_name": "baz"
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 49,
                        "start_line": 1,
                        "start_col": 24
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 51,
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
        "end": 52,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52,
    "start_line": 1,
    "start_col": 0
  }
}

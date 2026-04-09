===source===
<?php class C { use T { T::foo as bar; } }
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
                          "new_modifier": null,
                          "new_name": "bar"
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 39,
                        "start_line": 1,
                        "start_col": 24
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 41,
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
        "end": 42,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42,
    "start_line": 1,
    "start_col": 0
  }
}

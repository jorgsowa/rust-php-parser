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
                        "end": 21
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
                              "end": 25
                            }
                          },
                          "method": {
                            "parts": [
                              "foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 27,
                              "end": 30
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "bar"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 34,
                              "end": 37
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 38
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 40
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}

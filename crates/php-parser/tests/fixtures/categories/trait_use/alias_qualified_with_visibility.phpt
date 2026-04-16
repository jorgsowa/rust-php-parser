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
                          "new_modifier": "Protected",
                          "new_name": {
                            "parts": [
                              "baz"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 44,
                              "end": 47
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 48
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}

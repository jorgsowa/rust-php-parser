===source===
<?php class A { use T { a as b ?><?php } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "a"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "b"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 29,
                              "end": 30
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

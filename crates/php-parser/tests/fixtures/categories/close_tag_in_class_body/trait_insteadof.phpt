===source===
<?php class A { use T, U { T::a insteadof U ?><?php } }
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
                    },
                    {
                      "parts": [
                        "U"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 27,
                              "end": 28
                            }
                          },
                          "method": {
                            "parts": [
                              "a"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 30,
                              "end": 31
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "U"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 42,
                                "end": 43
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 51
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 53
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}

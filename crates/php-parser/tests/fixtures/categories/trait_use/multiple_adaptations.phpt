===source===
<?php class C { use A, B { A::m insteadof B; B::n as public nAlias; } }
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
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 27,
                              "end": 28
                            }
                          },
                          "method": {
                            "name": "m",
                            "span": {
                              "start": 30,
                              "end": 31
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "B"
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
                        "end": 44
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 45,
                              "end": 46
                            }
                          },
                          "method": {
                            "name": "n",
                            "span": {
                              "start": 48,
                              "end": 49
                            }
                          },
                          "new_modifier": "Public",
                          "new_name": {
                            "name": "nAlias",
                            "span": {
                              "start": 60,
                              "end": 66
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 45,
                        "end": 67
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}

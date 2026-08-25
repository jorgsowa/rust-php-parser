===source===
<?php

class WithAdaptations
{
    /**
     * Resolve conflicting methods.
     */
    use BehaviorA, BehaviorB {
        BehaviorA::foo insteadof BehaviorB;
        BehaviorB::bar as protected;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "WithAdaptations",
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
                        "BehaviorA"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 91,
                        "end": 100
                      }
                    },
                    {
                      "parts": [
                        "BehaviorB"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 102,
                        "end": 111
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "BehaviorA"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 122,
                              "end": 131
                            }
                          },
                          "method": {
                            "parts": [
                              "foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 133,
                              "end": 136
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "BehaviorB"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 147,
                                "end": 156
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 122,
                        "end": 157
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "BehaviorB"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 166,
                              "end": 175
                            }
                          },
                          "method": {
                            "parts": [
                              "bar"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 177,
                              "end": 180
                            }
                          },
                          "new_modifier": "Protected",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 166,
                        "end": 194
                      }
                    }
                  ],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/**\n     * Resolve conflicting methods.\n     */",
                    "span": {
                      "start": 35,
                      "end": 82
                    }
                  }
                }
              },
              "span": {
                "start": 87,
                "end": 200
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 202
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 202
  }
}

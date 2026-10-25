===source===
<?php
class C { use A { array as bar; fn as baz; list as q; } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                        "A"
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
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 24,
                              "end": 29
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "bar"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 33,
                              "end": 36
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 37
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "fn"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 38,
                              "end": 40
                            }
                          },
                          "new_modifier": null,
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
                        "start": 38,
                        "end": 48
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "list"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 49,
                              "end": 53
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "q"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 57,
                              "end": 58
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 59
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}

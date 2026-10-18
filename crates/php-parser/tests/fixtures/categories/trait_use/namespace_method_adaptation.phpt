===source===
<?php
class C {
    use A, B {
        namespace as bar;
        namespace as protected;
        A::namespace insteadof B;
        namespace\T::foo as baz;
    }
}
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
                        "start": 24,
                        "end": 25
                      }
                    },
                    {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 27,
                        "end": 28
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
                              "namespace"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 39,
                              "end": 48
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "bar"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 52,
                              "end": 55
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 39,
                        "end": 56
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "namespace"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 65,
                              "end": 74
                            }
                          },
                          "new_modifier": "Protected",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 65,
                        "end": 88
                      }
                    },
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 97,
                              "end": 98
                            }
                          },
                          "method": {
                            "parts": [
                              "namespace"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 100,
                              "end": 109
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 120,
                                "end": 121
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 97,
                        "end": 122
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "T"
                            ],
                            "kind": "Relative",
                            "span": {
                              "start": 131,
                              "end": 142
                            }
                          },
                          "method": {
                            "parts": [
                              "foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 144,
                              "end": 147
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "baz"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 151,
                              "end": 154
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 131,
                        "end": 155
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 161
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 163
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163
  }
}

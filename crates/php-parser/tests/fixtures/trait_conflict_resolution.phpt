===source===
<?php
class MyClass {
    use A, B {
        A::foo insteadof B;
        B::foo as baz;
        foo as bar;
        foo as protected;
        A::hello as private hi;
        A::big insteadof B, C;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "MyClass",
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
                        "start": 30,
                        "end": 31
                      }
                    },
                    {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 33,
                        "end": 34
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
                              "start": 45,
                              "end": 46
                            }
                          },
                          "method": "foo",
                          "insteadof": [
                            {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 62,
                                "end": 63
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 45,
                        "end": 64
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
                              "start": 73,
                              "end": 74
                            }
                          },
                          "method": "foo",
                          "new_modifier": null,
                          "new_name": "baz"
                        }
                      },
                      "span": {
                        "start": 73,
                        "end": 87
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": "foo",
                          "new_modifier": null,
                          "new_name": "bar"
                        }
                      },
                      "span": {
                        "start": 96,
                        "end": 107
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": "foo",
                          "new_modifier": "Protected",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 116,
                        "end": 133
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 142,
                              "end": 143
                            }
                          },
                          "method": "hello",
                          "new_modifier": "Private",
                          "new_name": "hi"
                        }
                      },
                      "span": {
                        "start": 142,
                        "end": 165
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
                              "start": 174,
                              "end": 175
                            }
                          },
                          "method": "big",
                          "insteadof": [
                            {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 191,
                                "end": 192
                              }
                            },
                            {
                              "parts": [
                                "C"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 194,
                                "end": 195
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 174,
                        "end": 196
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 26,
                "end": 202
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 204
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 204
  }
}

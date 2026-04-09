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
                        "end": 31,
                        "start_line": 3,
                        "start_col": 8
                      }
                    },
                    {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 33,
                        "end": 35,
                        "start_line": 3,
                        "start_col": 11
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
                              "end": 46,
                              "start_line": 4,
                              "start_col": 8
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
                                "end": 63,
                                "start_line": 4,
                                "start_col": 25
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 45,
                        "end": 73,
                        "start_line": 4,
                        "start_col": 8
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
                              "end": 74,
                              "start_line": 5,
                              "start_col": 8
                            }
                          },
                          "method": "foo",
                          "new_modifier": null,
                          "new_name": "baz"
                        }
                      },
                      "span": {
                        "start": 73,
                        "end": 96,
                        "start_line": 5,
                        "start_col": 8
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
                        "end": 116,
                        "start_line": 6,
                        "start_col": 8
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
                        "end": 142,
                        "start_line": 7,
                        "start_col": 8
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
                              "end": 143,
                              "start_line": 8,
                              "start_col": 8
                            }
                          },
                          "method": "hello",
                          "new_modifier": "Private",
                          "new_name": "hi"
                        }
                      },
                      "span": {
                        "start": 142,
                        "end": 174,
                        "start_line": 8,
                        "start_col": 8
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
                              "end": 175,
                              "start_line": 9,
                              "start_col": 8
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
                                "end": 192,
                                "start_line": 9,
                                "start_col": 25
                              }
                            },
                            {
                              "parts": [
                                "C"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 194,
                                "end": 195,
                                "start_line": 9,
                                "start_col": 28
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 174,
                        "end": 201,
                        "start_line": 9,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 26,
                "end": 203,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 204,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 204,
    "start_line": 1,
    "start_col": 0
  }
}

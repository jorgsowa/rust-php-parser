===source===
<?php
trait A { public function foo() {} }
trait B { public function foo() {} public function bar() {} }
class C {
    use A, B {
        B::foo insteadof A;
        A::foo as private afoo;
        B::bar as public bbar;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "A",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "foo",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
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
    },
    {
      "kind": {
        "Trait": {
          "name": "B",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "foo",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 53,
                "end": 77
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "bar",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 78,
                "end": 102
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 43,
        "end": 104
      }
    },
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
                        "start": 123,
                        "end": 124
                      }
                    },
                    {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 126,
                        "end": 127
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 138,
                              "end": 139
                            }
                          },
                          "method": {
                            "name": "foo",
                            "span": {
                              "start": 141,
                              "end": 144
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 155,
                                "end": 156
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 138,
                        "end": 157
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
                              "start": 166,
                              "end": 167
                            }
                          },
                          "method": {
                            "name": "foo",
                            "span": {
                              "start": 169,
                              "end": 172
                            }
                          },
                          "new_modifier": "Private",
                          "new_name": {
                            "name": "afoo",
                            "span": {
                              "start": 184,
                              "end": 188
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 166,
                        "end": 189
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
                              "start": 198,
                              "end": 199
                            }
                          },
                          "method": {
                            "name": "bar",
                            "span": {
                              "start": 201,
                              "end": 204
                            }
                          },
                          "new_modifier": "Public",
                          "new_name": {
                            "name": "bbar",
                            "span": {
                              "start": 215,
                              "end": 219
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 198,
                        "end": 220
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 119,
                "end": 226
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 105,
        "end": 228
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 228
  }
}

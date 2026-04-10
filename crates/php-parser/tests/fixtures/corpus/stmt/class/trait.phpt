===source===
<?php

trait A {
    public function a() {}
}

class B {
    use C;
    use D {
        a as protected b;
        c as d;
        e as private;
    }
    use E, F, G {
        E::a insteadof F, G;
        E::b as protected c;
        E::d as e;
        E::f as private;
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
                  "name": "a",
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
                "start": 21,
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 45
      }
    },
    {
      "kind": {
        "Class": {
          "name": "B",
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
                        "C"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 65,
                        "end": 66
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 61,
                "end": 67
              }
            },
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "D"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 76,
                        "end": 77
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": "a",
                          "new_modifier": "Protected",
                          "new_name": "b"
                        }
                      },
                      "span": {
                        "start": 88,
                        "end": 105
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": "c",
                          "new_modifier": null,
                          "new_name": "d"
                        }
                      },
                      "span": {
                        "start": 114,
                        "end": 121
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": "e",
                          "new_modifier": "Private",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 130,
                        "end": 143
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 72,
                "end": 149
              }
            },
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "E"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 158,
                        "end": 159
                      }
                    },
                    {
                      "parts": [
                        "F"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 161,
                        "end": 162
                      }
                    },
                    {
                      "parts": [
                        "G"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 164,
                        "end": 165
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "E"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 176,
                              "end": 177
                            }
                          },
                          "method": "a",
                          "insteadof": [
                            {
                              "parts": [
                                "F"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 191,
                                "end": 192
                              }
                            },
                            {
                              "parts": [
                                "G"
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
                        "start": 176,
                        "end": 196
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "E"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 205,
                              "end": 206
                            }
                          },
                          "method": "b",
                          "new_modifier": "Protected",
                          "new_name": "c"
                        }
                      },
                      "span": {
                        "start": 205,
                        "end": 225
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "E"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 234,
                              "end": 235
                            }
                          },
                          "method": "d",
                          "new_modifier": null,
                          "new_name": "e"
                        }
                      },
                      "span": {
                        "start": 234,
                        "end": 244
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "E"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 253,
                              "end": 254
                            }
                          },
                          "method": "f",
                          "new_modifier": "Private",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 253,
                        "end": 269
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 154,
                "end": 275
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 47,
        "end": 277
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 277
  }
}

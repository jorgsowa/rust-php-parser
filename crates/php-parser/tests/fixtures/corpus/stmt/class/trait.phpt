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
                "end": 44,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 45,
        "start_line": 3,
        "start_col": 0
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
                        "end": 66,
                        "start_line": 8,
                        "start_col": 8
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 61,
                "end": 72,
                "start_line": 8,
                "start_col": 4
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
                        "end": 78,
                        "start_line": 9,
                        "start_col": 8
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
                        "end": 114,
                        "start_line": 10,
                        "start_col": 8
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
                        "end": 130,
                        "start_line": 11,
                        "start_col": 8
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
                        "end": 148,
                        "start_line": 12,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 72,
                "end": 154,
                "start_line": 9,
                "start_col": 4
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
                        "end": 159,
                        "start_line": 14,
                        "start_col": 8
                      }
                    },
                    {
                      "parts": [
                        "F"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 161,
                        "end": 162,
                        "start_line": 14,
                        "start_col": 11
                      }
                    },
                    {
                      "parts": [
                        "G"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 164,
                        "end": 166,
                        "start_line": 14,
                        "start_col": 14
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
                              "end": 177,
                              "start_line": 15,
                              "start_col": 8
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
                                "end": 192,
                                "start_line": 15,
                                "start_col": 23
                              }
                            },
                            {
                              "parts": [
                                "G"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 194,
                                "end": 195,
                                "start_line": 15,
                                "start_col": 26
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 176,
                        "end": 205,
                        "start_line": 15,
                        "start_col": 8
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
                              "end": 206,
                              "start_line": 16,
                              "start_col": 8
                            }
                          },
                          "method": "b",
                          "new_modifier": "Protected",
                          "new_name": "c"
                        }
                      },
                      "span": {
                        "start": 205,
                        "end": 234,
                        "start_line": 16,
                        "start_col": 8
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
                              "end": 235,
                              "start_line": 17,
                              "start_col": 8
                            }
                          },
                          "method": "d",
                          "new_modifier": null,
                          "new_name": "e"
                        }
                      },
                      "span": {
                        "start": 234,
                        "end": 253,
                        "start_line": 17,
                        "start_col": 8
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
                              "end": 254,
                              "start_line": 18,
                              "start_col": 8
                            }
                          },
                          "method": "f",
                          "new_modifier": "Private",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 253,
                        "end": 274,
                        "start_line": 18,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 154,
                "end": 276,
                "start_line": 14,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 47,
        "end": 277,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 277,
    "start_line": 1,
    "start_col": 0
  }
}

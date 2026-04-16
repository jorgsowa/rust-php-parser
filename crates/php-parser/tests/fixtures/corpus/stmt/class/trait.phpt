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
                          "method": {
                            "name": "a",
                            "span": {
                              "start": 88,
                              "end": 89
                            }
                          },
                          "new_modifier": "Protected",
                          "new_name": {
                            "name": "b",
                            "span": {
                              "start": 103,
                              "end": 104
                            }
                          }
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
                          "method": {
                            "name": "c",
                            "span": {
                              "start": 114,
                              "end": 115
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "name": "d",
                            "span": {
                              "start": 119,
                              "end": 120
                            }
                          }
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
                          "method": {
                            "name": "e",
                            "span": {
                              "start": 130,
                              "end": 131
                            }
                          },
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
                          "method": {
                            "name": "a",
                            "span": {
                              "start": 179,
                              "end": 180
                            }
                          },
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
                          "method": {
                            "name": "b",
                            "span": {
                              "start": 208,
                              "end": 209
                            }
                          },
                          "new_modifier": "Protected",
                          "new_name": {
                            "name": "c",
                            "span": {
                              "start": 223,
                              "end": 224
                            }
                          }
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
                          "method": {
                            "name": "d",
                            "span": {
                              "start": 237,
                              "end": 238
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "name": "e",
                            "span": {
                              "start": 242,
                              "end": 243
                            }
                          }
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
                          "method": {
                            "name": "f",
                            "span": {
                              "start": 256,
                              "end": 257
                            }
                          },
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

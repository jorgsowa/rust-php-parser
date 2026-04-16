===source===
<?php
trait T1 { public function m() {} }
trait T2 { public function m() {} }
trait T3 { public function m() {} }
class C {
    use T1, T2, T3 {
        T1::m insteadof T2, T3;
        T2::m insteadof T3;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "T1",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "m",
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
                "start": 17,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    },
    {
      "kind": {
        "Trait": {
          "name": "T2",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "m",
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
                "end": 75
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 42,
        "end": 77
      }
    },
    {
      "kind": {
        "Trait": {
          "name": "T3",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "m",
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
                "start": 89,
                "end": 111
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 78,
        "end": 113
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
                        "T1"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 132,
                        "end": 134
                      }
                    },
                    {
                      "parts": [
                        "T2"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 136,
                        "end": 138
                      }
                    },
                    {
                      "parts": [
                        "T3"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 140,
                        "end": 142
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "T1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 153,
                              "end": 155
                            }
                          },
                          "method": {
                            "name": "m",
                            "span": {
                              "start": 157,
                              "end": 158
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "T2"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 169,
                                "end": 171
                              }
                            },
                            {
                              "parts": [
                                "T3"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 173,
                                "end": 175
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 153,
                        "end": 176
                      }
                    },
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "T2"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 185,
                              "end": 187
                            }
                          },
                          "method": {
                            "name": "m",
                            "span": {
                              "start": 189,
                              "end": 190
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "T3"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 201,
                                "end": 203
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 185,
                        "end": 204
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 128,
                "end": 210
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 114,
        "end": 212
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 212
  }
}

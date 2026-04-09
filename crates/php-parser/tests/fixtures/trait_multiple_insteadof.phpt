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
                "end": 40,
                "start_line": 2,
                "start_col": 11
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41,
        "start_line": 2,
        "start_col": 0
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
                "end": 76,
                "start_line": 3,
                "start_col": 11
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 42,
        "end": 77,
        "start_line": 3,
        "start_col": 0
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
                "end": 112,
                "start_line": 4,
                "start_col": 11
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 78,
        "end": 113,
        "start_line": 4,
        "start_col": 0
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
                        "end": 134,
                        "start_line": 6,
                        "start_col": 8
                      }
                    },
                    {
                      "parts": [
                        "T2"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 136,
                        "end": 138,
                        "start_line": 6,
                        "start_col": 12
                      }
                    },
                    {
                      "parts": [
                        "T3"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 140,
                        "end": 143,
                        "start_line": 6,
                        "start_col": 16
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
                              "end": 155,
                              "start_line": 7,
                              "start_col": 8
                            }
                          },
                          "method": "m",
                          "insteadof": [
                            {
                              "parts": [
                                "T2"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 169,
                                "end": 171,
                                "start_line": 7,
                                "start_col": 24
                              }
                            },
                            {
                              "parts": [
                                "T3"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 173,
                                "end": 175,
                                "start_line": 7,
                                "start_col": 28
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 153,
                        "end": 185,
                        "start_line": 7,
                        "start_col": 8
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
                              "end": 187,
                              "start_line": 8,
                              "start_col": 8
                            }
                          },
                          "method": "m",
                          "insteadof": [
                            {
                              "parts": [
                                "T3"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 201,
                                "end": 203,
                                "start_line": 8,
                                "start_col": 24
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 185,
                        "end": 209,
                        "start_line": 8,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 128,
                "end": 211,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 114,
        "end": 212,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 212,
    "start_line": 1,
    "start_col": 0
  }
}

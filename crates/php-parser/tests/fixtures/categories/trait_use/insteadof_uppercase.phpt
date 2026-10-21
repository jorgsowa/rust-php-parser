===source===
<?php
trait T { function a() {} }
trait U { function a() {} }
class A {
    use T, U { T::a INSTEADOF U; U::a InsteadOf T; }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 25,
                      "end": 26
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 31
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "U",
            "span": {
              "start": 40,
              "end": 41
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 53,
                      "end": 54
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 34,
        "end": 61
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 68,
              "end": 69
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
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 80,
                        "end": 81
                      }
                    },
                    {
                      "parts": [
                        "U"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 83,
                        "end": 84
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 87,
                              "end": 88
                            }
                          },
                          "method": {
                            "parts": [
                              "a"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 90,
                              "end": 91
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "U"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 102,
                                "end": 103
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 87,
                        "end": 104
                      }
                    },
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "U"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 105,
                              "end": 106
                            }
                          },
                          "method": {
                            "parts": [
                              "a"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 108,
                              "end": 109
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "T"
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
                        "start": 105,
                        "end": 122
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 76,
                "end": 124
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 62,
        "end": 126
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 126
  }
}

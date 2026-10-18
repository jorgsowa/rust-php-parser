===source===
<?php
class A {
    use T, self;
    use \parent;
    use T {
        static::f insteadof B;
        T::g insteadof self;
        parent::h as i;
    }
}
===errors===
Cannot use "self" as trait name, as it is reserved
'\parent' is an invalid class name
Cannot use "static" as trait name, as it is reserved
Cannot use "self" as trait name, as it is reserved
Cannot use "parent" as trait name, as it is reserved
===php_error===
PHP Fatal error:  Cannot use "self" as trait name, as it is reserved in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    },
                    {
                      "parts": [
                        "self"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 27,
                        "end": 31
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
              }
            },
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "parent"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 41,
                        "end": 48
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 37,
                "end": 49
              }
            },
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
                        "start": 58,
                        "end": 59
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 70,
                              "end": 76
                            }
                          },
                          "method": {
                            "parts": [
                              "f"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 78,
                              "end": 79
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 90,
                                "end": 91
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 92
                      }
                    },
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 101,
                              "end": 102
                            }
                          },
                          "method": {
                            "parts": [
                              "g"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 104,
                              "end": 105
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 116,
                                "end": 120
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 101,
                        "end": 121
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "parent"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 130,
                              "end": 136
                            }
                          },
                          "method": {
                            "parts": [
                              "h"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 138,
                              "end": 139
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "i"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 143,
                              "end": 144
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 130,
                        "end": 145
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 54,
                "end": 151
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 153
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 153
  }
}

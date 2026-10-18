===config===
min_php=8.4
===source===
<?php
class D {
    public PRIVATE(SET) int $a;
    Protected(Set) int $b;
    public function __construct(public private(Set) int $c, private (A&B)|null $d) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 44,
                      "end": 46
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 40,
                          "end": 43
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 43
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 46
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 71,
                      "end": 73
                    }
                  },
                  "visibility": null,
                  "set_visibility": "Protected",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 67,
                          "end": 70
                        }
                      }
                    },
                    "span": {
                      "start": 67,
                      "end": 70
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 52,
                "end": 73
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 95,
                      "end": 106
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "c",
                        "span": {
                          "start": 131,
                          "end": 133
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 127,
                              "end": 130
                            }
                          }
                        },
                        "span": {
                          "start": 127,
                          "end": 130
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": "Private",
                      "attributes": [],
                      "span": {
                        "start": 107,
                        "end": 133
                      }
                    },
                    {
                      "name": {
                        "name": "d",
                        "span": {
                          "start": 154,
                          "end": 156
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Union": [
                            {
                              "kind": {
                                "Intersection": [
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "A"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 144,
                                          "end": 145
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 144,
                                      "end": 145
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "B"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 146,
                                          "end": 147
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 146,
                                      "end": 147
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 143,
                                "end": 148
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "null"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 149,
                                    "end": 153
                                  }
                                }
                              },
                              "span": {
                                "start": 149,
                                "end": 153
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 143,
                          "end": 153
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 135,
                        "end": 156
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 79,
                "end": 160
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 162
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 162
  }
}

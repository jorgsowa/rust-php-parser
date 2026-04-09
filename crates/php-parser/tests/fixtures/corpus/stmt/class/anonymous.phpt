===source===
<?php

new class {
    public function test() {}
};
new class extends A implements B, C {};
new class() {
    public $foo;
};
new class($a, $b) extends A {
    use T;
};

class A {
    public function test() {
        return new class($this) extends A {
            const A = 'B';
        };
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
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
                          "Method": {
                            "name": "test",
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
                          "start": 23,
                          "end": 49,
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
                  "end": 50,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 50,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 52,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 70,
                        "end": 72,
                        "start_line": 6,
                        "start_col": 18
                      }
                    },
                    "implements": [
                      {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 83,
                          "end": 84,
                          "start_line": 6,
                          "start_col": 31
                        }
                      },
                      {
                        "parts": [
                          "C"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 86,
                          "end": 88,
                          "start_line": 6,
                          "start_col": 34
                        }
                      }
                    ],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 52,
                  "end": 90,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 52,
            "end": 90,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 52,
        "end": 92,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
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
                            "name": "foo",
                            "visibility": "Public",
                            "set_visibility": null,
                            "is_static": false,
                            "is_readonly": false,
                            "type_hint": null,
                            "default": null,
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 110,
                          "end": 121,
                          "start_line": 8,
                          "start_col": 4
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 92,
                  "end": 124,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 92,
            "end": 124,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 92,
        "end": 126,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 152,
                        "end": 154,
                        "start_line": 10,
                        "start_col": 26
                      }
                    },
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
                                  "start": 164,
                                  "end": 165,
                                  "start_line": 11,
                                  "start_col": 8
                                }
                              }
                            ],
                            "adaptations": []
                          }
                        },
                        "span": {
                          "start": 160,
                          "end": 167,
                          "start_line": 11,
                          "start_col": 4
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 126,
                  "end": 168,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 136,
                      "end": 138,
                      "start_line": 10,
                      "start_col": 10
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 136,
                    "end": 138,
                    "start_line": 10,
                    "start_col": 10
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 140,
                      "end": 142,
                      "start_line": 10,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 140,
                    "end": 142,
                    "start_line": 10,
                    "start_col": 14
                  }
                }
              ]
            }
          },
          "span": {
            "start": 126,
            "end": 168,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 126,
        "end": 171,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "A",
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
                "Method": {
                  "name": "test",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "AnonymousClass": {
                                    "name": null,
                                    "modifiers": {
                                      "is_abstract": false,
                                      "is_final": false,
                                      "is_readonly": false
                                    },
                                    "extends": {
                                      "parts": [
                                        "A"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 250,
                                        "end": 252,
                                        "start_line": 16,
                                        "start_col": 40
                                      }
                                    },
                                    "implements": [],
                                    "members": [
                                      {
                                        "kind": {
                                          "ClassConst": {
                                            "name": "A",
                                            "visibility": null,
                                            "value": {
                                              "kind": {
                                                "String": "B"
                                              },
                                              "span": {
                                                "start": 276,
                                                "end": 279,
                                                "start_line": 17,
                                                "start_col": 22
                                              }
                                            },
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 266,
                                          "end": 289,
                                          "start_line": 17,
                                          "start_col": 12
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 225,
                                  "end": 290,
                                  "start_line": 16,
                                  "start_col": 15
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "Variable": "this"
                                    },
                                    "span": {
                                      "start": 235,
                                      "end": 240,
                                      "start_line": 16,
                                      "start_col": 25
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 235,
                                    "end": 240,
                                    "start_line": 16,
                                    "start_col": 25
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 225,
                            "end": 290,
                            "start_line": 16,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 218,
                        "end": 296,
                        "start_line": 16,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 185,
                "end": 298,
                "start_line": 15,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 171,
        "end": 299,
        "start_line": 14,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 299,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php
function f((A&B)|C|null $x): (X&Y)|(P&Q)|null {
    return $x;
}
class Foo {
    public (A&B)|C $prop;
    public function bar((A&B)|(C&D) $a, E|null $b): (F&G)|null {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [
            {
              "name": "x",
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
                                  "start": 18,
                                  "end": 19,
                                  "start_line": 2,
                                  "start_col": 12
                                }
                              }
                            },
                            "span": {
                              "start": 18,
                              "end": 19,
                              "start_line": 2,
                              "start_col": 12
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
                                  "start": 20,
                                  "end": 21,
                                  "start_line": 2,
                                  "start_col": 14
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 21,
                              "start_line": 2,
                              "start_col": 14
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 17,
                        "end": 22,
                        "start_line": 2,
                        "start_col": 11
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 24,
                            "start_line": 2,
                            "start_col": 17
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 24,
                        "start_line": 2,
                        "start_col": 17
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
                            "start": 25,
                            "end": 29,
                            "start_line": 2,
                            "start_col": 19
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 29,
                        "start_line": 2,
                        "start_col": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 29,
                  "start_line": 2,
                  "start_col": 11
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 32,
                "start_line": 2,
                "start_col": 11
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 65,
                    "end": 67,
                    "start_line": 3,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 58,
                "end": 69,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "X"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 36,
                              "end": 37,
                              "start_line": 2,
                              "start_col": 30
                            }
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 37,
                          "start_line": 2,
                          "start_col": 30
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Y"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 38,
                              "end": 39,
                              "start_line": 2,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 38,
                          "end": 39,
                          "start_line": 2,
                          "start_col": 32
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 35,
                    "end": 40,
                    "start_line": 2,
                    "start_col": 29
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "P"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 42,
                              "end": 43,
                              "start_line": 2,
                              "start_col": 36
                            }
                          }
                        },
                        "span": {
                          "start": 42,
                          "end": 43,
                          "start_line": 2,
                          "start_col": 36
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Q"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 44,
                              "end": 45,
                              "start_line": 2,
                              "start_col": 38
                            }
                          }
                        },
                        "span": {
                          "start": 44,
                          "end": 45,
                          "start_line": 2,
                          "start_col": 38
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 41,
                    "end": 46,
                    "start_line": 2,
                    "start_col": 35
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
                        "start": 47,
                        "end": 51,
                        "start_line": 2,
                        "start_col": 41
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 51,
                    "start_line": 2,
                    "start_col": 41
                  }
                }
              ]
            },
            "span": {
              "start": 35,
              "end": 51,
              "start_line": 2,
              "start_col": 29
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 70,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                                      "start": 95,
                                      "end": 96,
                                      "start_line": 6,
                                      "start_col": 12
                                    }
                                  }
                                },
                                "span": {
                                  "start": 95,
                                  "end": 96,
                                  "start_line": 6,
                                  "start_col": 12
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
                                      "start": 97,
                                      "end": 98,
                                      "start_line": 6,
                                      "start_col": 14
                                    }
                                  }
                                },
                                "span": {
                                  "start": 97,
                                  "end": 98,
                                  "start_line": 6,
                                  "start_col": 14
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 94,
                            "end": 99,
                            "start_line": 6,
                            "start_col": 11
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "C"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 100,
                                "end": 102,
                                "start_line": 6,
                                "start_col": 17
                              }
                            }
                          },
                          "span": {
                            "start": 100,
                            "end": 102,
                            "start_line": 6,
                            "start_col": 17
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 94,
                      "end": 102,
                      "start_line": 6,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 87,
                "end": 107,
                "start_line": 6,
                "start_col": 4
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
                  "params": [
                    {
                      "name": "a",
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
                                          "start": 134,
                                          "end": 135,
                                          "start_line": 7,
                                          "start_col": 25
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 134,
                                      "end": 135,
                                      "start_line": 7,
                                      "start_col": 25
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
                                          "start": 136,
                                          "end": 137,
                                          "start_line": 7,
                                          "start_col": 27
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 136,
                                      "end": 137,
                                      "start_line": 7,
                                      "start_col": 27
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 133,
                                "end": 138,
                                "start_line": 7,
                                "start_col": 24
                              }
                            },
                            {
                              "kind": {
                                "Intersection": [
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "C"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 140,
                                          "end": 141,
                                          "start_line": 7,
                                          "start_col": 31
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 140,
                                      "end": 141,
                                      "start_line": 7,
                                      "start_col": 31
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "D"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 142,
                                          "end": 143,
                                          "start_line": 7,
                                          "start_col": 33
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 142,
                                      "end": 143,
                                      "start_line": 7,
                                      "start_col": 33
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 139,
                                "end": 144,
                                "start_line": 7,
                                "start_col": 30
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 133,
                          "end": 144,
                          "start_line": 7,
                          "start_col": 24
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 133,
                        "end": 147,
                        "start_line": 7,
                        "start_col": 24
                      }
                    },
                    {
                      "name": "b",
                      "type_hint": {
                        "kind": {
                          "Union": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "E"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 149,
                                    "end": 150,
                                    "start_line": 7,
                                    "start_col": 40
                                  }
                                }
                              },
                              "span": {
                                "start": 149,
                                "end": 150,
                                "start_line": 7,
                                "start_col": 40
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
                                    "start": 151,
                                    "end": 155,
                                    "start_line": 7,
                                    "start_col": 42
                                  }
                                }
                              },
                              "span": {
                                "start": 151,
                                "end": 155,
                                "start_line": 7,
                                "start_col": 42
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 149,
                          "end": 155,
                          "start_line": 7,
                          "start_col": 40
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 149,
                        "end": 158,
                        "start_line": 7,
                        "start_col": 40
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "F"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 162,
                                      "end": 163,
                                      "start_line": 7,
                                      "start_col": 53
                                    }
                                  }
                                },
                                "span": {
                                  "start": 162,
                                  "end": 163,
                                  "start_line": 7,
                                  "start_col": 53
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "G"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 164,
                                      "end": 165,
                                      "start_line": 7,
                                      "start_col": 55
                                    }
                                  }
                                },
                                "span": {
                                  "start": 164,
                                  "end": 165,
                                  "start_line": 7,
                                  "start_col": 55
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 161,
                            "end": 166,
                            "start_line": 7,
                            "start_col": 52
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
                                "start": 167,
                                "end": 171,
                                "start_line": 7,
                                "start_col": 58
                              }
                            }
                          },
                          "span": {
                            "start": 167,
                            "end": 171,
                            "start_line": 7,
                            "start_col": 58
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 161,
                      "end": 171,
                      "start_line": 7,
                      "start_col": 52
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 113,
                "end": 175,
                "start_line": 7,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 71,
        "end": 176,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 176,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php

class Test {
    public (A&B)|(X&Y) $prop;
    public readonly (A&B)|C $prop2;
}

function test((A&B)|(X&Y) $a): (A&B)|(X&Y) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
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
                                      "start": 32,
                                      "end": 33,
                                      "start_line": 4,
                                      "start_col": 12
                                    }
                                  }
                                },
                                "span": {
                                  "start": 32,
                                  "end": 33,
                                  "start_line": 4,
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
                                      "start": 34,
                                      "end": 35,
                                      "start_line": 4,
                                      "start_col": 14
                                    }
                                  }
                                },
                                "span": {
                                  "start": 34,
                                  "end": 35,
                                  "start_line": 4,
                                  "start_col": 14
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 31,
                            "end": 36,
                            "start_line": 4,
                            "start_col": 11
                          }
                        },
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
                                      "start": 38,
                                      "end": 39,
                                      "start_line": 4,
                                      "start_col": 18
                                    }
                                  }
                                },
                                "span": {
                                  "start": 38,
                                  "end": 39,
                                  "start_line": 4,
                                  "start_col": 18
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
                                      "start": 40,
                                      "end": 41,
                                      "start_line": 4,
                                      "start_col": 20
                                    }
                                  }
                                },
                                "span": {
                                  "start": 40,
                                  "end": 41,
                                  "start_line": 4,
                                  "start_col": 20
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 37,
                            "end": 42,
                            "start_line": 4,
                            "start_col": 17
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 31,
                      "end": 42,
                      "start_line": 4,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 48,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "prop2",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
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
                                      "start": 71,
                                      "end": 72,
                                      "start_line": 5,
                                      "start_col": 21
                                    }
                                  }
                                },
                                "span": {
                                  "start": 71,
                                  "end": 72,
                                  "start_line": 5,
                                  "start_col": 21
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
                                      "start": 73,
                                      "end": 74,
                                      "start_line": 5,
                                      "start_col": 23
                                    }
                                  }
                                },
                                "span": {
                                  "start": 73,
                                  "end": 74,
                                  "start_line": 5,
                                  "start_col": 23
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 70,
                            "end": 75,
                            "start_line": 5,
                            "start_col": 20
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
                                "start": 76,
                                "end": 78,
                                "start_line": 5,
                                "start_col": 26
                              }
                            }
                          },
                          "span": {
                            "start": 76,
                            "end": 78,
                            "start_line": 5,
                            "start_col": 26
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 70,
                      "end": 78,
                      "start_line": 5,
                      "start_col": 20
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 84,
                "start_line": 5,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 87,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test",
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
                                  "start": 104,
                                  "end": 105,
                                  "start_line": 8,
                                  "start_col": 15
                                }
                              }
                            },
                            "span": {
                              "start": 104,
                              "end": 105,
                              "start_line": 8,
                              "start_col": 15
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
                                  "start": 106,
                                  "end": 107,
                                  "start_line": 8,
                                  "start_col": 17
                                }
                              }
                            },
                            "span": {
                              "start": 106,
                              "end": 107,
                              "start_line": 8,
                              "start_col": 17
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 103,
                        "end": 108,
                        "start_line": 8,
                        "start_col": 14
                      }
                    },
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
                                  "start": 110,
                                  "end": 111,
                                  "start_line": 8,
                                  "start_col": 21
                                }
                              }
                            },
                            "span": {
                              "start": 110,
                              "end": 111,
                              "start_line": 8,
                              "start_col": 21
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
                                  "start": 112,
                                  "end": 113,
                                  "start_line": 8,
                                  "start_col": 23
                                }
                              }
                            },
                            "span": {
                              "start": 112,
                              "end": 113,
                              "start_line": 8,
                              "start_col": 23
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 109,
                        "end": 114,
                        "start_line": 8,
                        "start_col": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 103,
                  "end": 114,
                  "start_line": 8,
                  "start_col": 14
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
                "start": 103,
                "end": 117,
                "start_line": 8,
                "start_col": 14
              }
            }
          ],
          "body": [],
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
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 121,
                              "end": 122,
                              "start_line": 8,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 121,
                          "end": 122,
                          "start_line": 8,
                          "start_col": 32
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
                              "start": 123,
                              "end": 124,
                              "start_line": 8,
                              "start_col": 34
                            }
                          }
                        },
                        "span": {
                          "start": 123,
                          "end": 124,
                          "start_line": 8,
                          "start_col": 34
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 120,
                    "end": 125,
                    "start_line": 8,
                    "start_col": 31
                  }
                },
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
                              "start": 127,
                              "end": 128,
                              "start_line": 8,
                              "start_col": 38
                            }
                          }
                        },
                        "span": {
                          "start": 127,
                          "end": 128,
                          "start_line": 8,
                          "start_col": 38
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
                              "start": 129,
                              "end": 130,
                              "start_line": 8,
                              "start_col": 40
                            }
                          }
                        },
                        "span": {
                          "start": 129,
                          "end": 130,
                          "start_line": 8,
                          "start_col": 40
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 126,
                    "end": 131,
                    "start_line": 8,
                    "start_col": 37
                  }
                }
              ]
            },
            "span": {
              "start": 120,
              "end": 131,
              "start_line": 8,
              "start_col": 31
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 89,
        "end": 134,
        "start_line": 8,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 134,
    "start_line": 1,
    "start_col": 0
  }
}

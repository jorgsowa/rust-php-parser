===source===
<?php

class Test {
    public (A&B)|(X&Y) $prop;
    public readonly (A&B)|C $prop2;
}

function test((A&B)|(X&Y) $a): (A&B)|(X&Y) {}
===ast >=8.2===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 13,
              "end": 17
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
                    "name": "prop",
                    "span": {
                      "start": 43,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                      "start": 32,
                                      "end": 33
                                    }
                                  }
                                },
                                "span": {
                                  "start": 32,
                                  "end": 33
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
                                      "end": 35
                                    }
                                  }
                                },
                                "span": {
                                  "start": 34,
                                  "end": 35
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 31,
                            "end": 36
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
                                      "end": 39
                                    }
                                  }
                                },
                                "span": {
                                  "start": 38,
                                  "end": 39
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
                                      "end": 41
                                    }
                                  }
                                },
                                "span": {
                                  "start": 40,
                                  "end": 41
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 37,
                            "end": 42
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 31,
                      "end": 42
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 48
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop2",
                    "span": {
                      "start": 78,
                      "end": 84
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
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
                                      "start": 71,
                                      "end": 72
                                    }
                                  }
                                },
                                "span": {
                                  "start": 71,
                                  "end": 72
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
                                      "end": 74
                                    }
                                  }
                                },
                                "span": {
                                  "start": 73,
                                  "end": 74
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 70,
                            "end": 75
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
                                "end": 77
                              }
                            }
                          },
                          "span": {
                            "start": 76,
                            "end": 77
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 70,
                      "end": 77
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 84
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 87
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 98,
              "end": 102
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 115,
                  "end": 117
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
                                  "start": 104,
                                  "end": 105
                                }
                              }
                            },
                            "span": {
                              "start": 104,
                              "end": 105
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
                                  "end": 107
                                }
                              }
                            },
                            "span": {
                              "start": 106,
                              "end": 107
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 103,
                        "end": 108
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
                                  "end": 111
                                }
                              }
                            },
                            "span": {
                              "start": 110,
                              "end": 111
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
                                  "end": 113
                                }
                              }
                            },
                            "span": {
                              "start": 112,
                              "end": 113
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 109,
                        "end": 114
                      }
                    }
                  ]
                },
                "span": {
                  "start": 103,
                  "end": 114
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 103,
                "end": 117
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
                              "end": 122
                            }
                          }
                        },
                        "span": {
                          "start": 121,
                          "end": 122
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
                              "end": 124
                            }
                          }
                        },
                        "span": {
                          "start": 123,
                          "end": 124
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 120,
                    "end": 125
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
                              "end": 128
                            }
                          }
                        },
                        "span": {
                          "start": 127,
                          "end": 128
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
                              "end": 130
                            }
                          }
                        },
                        "span": {
                          "start": 129,
                          "end": 130
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 126,
                    "end": 131
                  }
                }
              ]
            },
            "span": {
              "start": 120,
              "end": 131
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 89,
        "end": 134
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 134
  }
}

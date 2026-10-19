===config===
min_php=8.2

===source===
<?php
function a(): A|(A&B) {}
function b(): (A&B)|A {}
function c(): (A&B)|(A&B&C) {}
function d(): (A&B&C)|(B&A) {}
function e(): (A&B)|(b&a) {}
function f(): (A&B)|(\A&B) {}
function g(): A|B|(A&C)|(B&D) {}
class K {
    public function h(): (self&B)|K {}
}
===errors===
Type A&B is redundant as it is more restrictive than type A
Type A&B is redundant as it is more restrictive than type A
Type A&B&C is redundant as it is more restrictive than type A&B
Type A&B&C is redundant as it is more restrictive than type B&A
Type b&a is redundant with type A&B
Type A&B is redundant with type A&B
Type A&C is redundant as it is more restrictive than type A
Type B&D is redundant as it is more restrictive than type B
Type K&B is redundant as it is more restrictive than type K
===php_error===
PHP Fatal error:  Type A&B is redundant as it is more restrictive than type A in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 21
                  }
                },
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
                              "start": 23,
                              "end": 24
                            }
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 24
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
                              "start": 25,
                              "end": 26
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 26
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 22,
                    "end": 27
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 27
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 40,
              "end": 41
            }
          },
          "params": [],
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
                              "start": 46,
                              "end": 47
                            }
                          }
                        },
                        "span": {
                          "start": 46,
                          "end": 47
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
                              "start": 48,
                              "end": 49
                            }
                          }
                        },
                        "span": {
                          "start": 48,
                          "end": 49
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 45,
                    "end": 50
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 51,
                        "end": 52
                      }
                    }
                  },
                  "span": {
                    "start": 51,
                    "end": 52
                  }
                }
              ]
            },
            "span": {
              "start": 45,
              "end": 52
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 31,
        "end": 55
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 65,
              "end": 66
            }
          },
          "params": [],
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
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 77,
                              "end": 78
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 78
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
                              "start": 79,
                              "end": 80
                            }
                          }
                        },
                        "span": {
                          "start": 79,
                          "end": 80
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
                              "start": 81,
                              "end": 82
                            }
                          }
                        },
                        "span": {
                          "start": 81,
                          "end": 82
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 76,
                    "end": 83
                  }
                }
              ]
            },
            "span": {
              "start": 70,
              "end": 83
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 56,
        "end": 86
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
            "span": {
              "start": 96,
              "end": 97
            }
          },
          "params": [],
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
                              "start": 102,
                              "end": 103
                            }
                          }
                        },
                        "span": {
                          "start": 102,
                          "end": 103
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
                              "C"
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
                    "start": 101,
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
                              "B"
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
                              "A"
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
              "start": 101,
              "end": 114
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 87,
        "end": 117
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "e",
            "span": {
              "start": 127,
              "end": 128
            }
          },
          "params": [],
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
                              "start": 133,
                              "end": 134
                            }
                          }
                        },
                        "span": {
                          "start": 133,
                          "end": 134
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
                              "start": 135,
                              "end": 136
                            }
                          }
                        },
                        "span": {
                          "start": 135,
                          "end": 136
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 132,
                    "end": 137
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "b"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 139,
                              "end": 140
                            }
                          }
                        },
                        "span": {
                          "start": 139,
                          "end": 140
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "a"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 141,
                              "end": 142
                            }
                          }
                        },
                        "span": {
                          "start": 141,
                          "end": 142
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 138,
                    "end": 143
                  }
                }
              ]
            },
            "span": {
              "start": 132,
              "end": 143
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 118,
        "end": 146
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 156,
              "end": 157
            }
          },
          "params": [],
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
                              "start": 162,
                              "end": 163
                            }
                          }
                        },
                        "span": {
                          "start": 162,
                          "end": 163
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
                              "start": 164,
                              "end": 165
                            }
                          }
                        },
                        "span": {
                          "start": 164,
                          "end": 165
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 161,
                    "end": 166
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "FullyQualified",
                            "span": {
                              "start": 168,
                              "end": 170
                            }
                          }
                        },
                        "span": {
                          "start": 168,
                          "end": 170
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
                              "start": 171,
                              "end": 172
                            }
                          }
                        },
                        "span": {
                          "start": 171,
                          "end": 172
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 167,
                    "end": 173
                  }
                }
              ]
            },
            "span": {
              "start": 161,
              "end": 173
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 147,
        "end": 176
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 186,
              "end": 187
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 191,
                        "end": 192
                      }
                    }
                  },
                  "span": {
                    "start": 191,
                    "end": 192
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
                        "start": 193,
                        "end": 194
                      }
                    }
                  },
                  "span": {
                    "start": 193,
                    "end": 194
                  }
                },
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
                              "start": 196,
                              "end": 197
                            }
                          }
                        },
                        "span": {
                          "start": 196,
                          "end": 197
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
                              "start": 198,
                              "end": 199
                            }
                          }
                        },
                        "span": {
                          "start": 198,
                          "end": 199
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 195,
                    "end": 200
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 202,
                              "end": 203
                            }
                          }
                        },
                        "span": {
                          "start": 202,
                          "end": 203
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
                              "start": 204,
                              "end": 205
                            }
                          }
                        },
                        "span": {
                          "start": 204,
                          "end": 205
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 201,
                    "end": 206
                  }
                }
              ]
            },
            "span": {
              "start": 191,
              "end": 206
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 177,
        "end": 209
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "K",
            "span": {
              "start": 216,
              "end": 217
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
                "Method": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 240,
                      "end": 241
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
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
                                      "self"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 246,
                                      "end": 250
                                    }
                                  }
                                },
                                "span": {
                                  "start": 246,
                                  "end": 250
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
                                      "start": 251,
                                      "end": 252
                                    }
                                  }
                                },
                                "span": {
                                  "start": 251,
                                  "end": 252
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 245,
                            "end": 253
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "K"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 254,
                                "end": 255
                              }
                            }
                          },
                          "span": {
                            "start": 254,
                            "end": 255
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 245,
                      "end": 255
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 224,
                "end": 258
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 210,
        "end": 260
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 260
  }
}

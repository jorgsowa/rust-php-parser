===config===
min_php=8.2

===source===
<?php
// DNF: parenthesized intersection union
function test1((A&B)|(C&D) $x) {}

// DNF: nested parenthesized intersections in union
function test2((A&B)|(C&D)|(E&F) $x) {}

// Unparenthesized union (PHP 8.0+)
function test3(A|B $x) {}

// In property type - DNF with parenthesized intersections
class X {
    public (A&B)|(C&D) $prop1;
    public (A&B)|(C&D)|(E&F) $prop2;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test1",
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
                                  "start": 63,
                                  "end": 64
                                }
                              }
                            },
                            "span": {
                              "start": 63,
                              "end": 64
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
                                  "start": 65,
                                  "end": 66
                                }
                              }
                            },
                            "span": {
                              "start": 65,
                              "end": 66
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 62,
                        "end": 67
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
                                  "start": 69,
                                  "end": 70
                                }
                              }
                            },
                            "span": {
                              "start": 69,
                              "end": 70
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
                                  "start": 71,
                                  "end": 72
                                }
                              }
                            },
                            "span": {
                              "start": 71,
                              "end": 72
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 68,
                        "end": 73
                      }
                    }
                  ]
                },
                "span": {
                  "start": 62,
                  "end": 73
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
                "start": 62,
                "end": 76
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 47,
        "end": 80
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test2",
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
                                  "start": 150,
                                  "end": 151
                                }
                              }
                            },
                            "span": {
                              "start": 150,
                              "end": 151
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
                                  "start": 152,
                                  "end": 153
                                }
                              }
                            },
                            "span": {
                              "start": 152,
                              "end": 153
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 149,
                        "end": 154
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
                                  "start": 156,
                                  "end": 157
                                }
                              }
                            },
                            "span": {
                              "start": 156,
                              "end": 157
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
                                  "start": 158,
                                  "end": 159
                                }
                              }
                            },
                            "span": {
                              "start": 158,
                              "end": 159
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 155,
                        "end": 160
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "E"
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
                                  "F"
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
                    }
                  ]
                },
                "span": {
                  "start": 149,
                  "end": 166
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
                "end": 169
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 134,
        "end": 173
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test3",
          "params": [
            {
              "name": "x",
              "type_hint": {
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
                            "start": 226,
                            "end": 227
                          }
                        }
                      },
                      "span": {
                        "start": 226,
                        "end": 227
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
                            "start": 228,
                            "end": 229
                          }
                        }
                      },
                      "span": {
                        "start": 228,
                        "end": 229
                      }
                    }
                  ]
                },
                "span": {
                  "start": 226,
                  "end": 229
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
                "start": 226,
                "end": 232
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 211,
        "end": 236
      }
    },
    {
      "kind": {
        "Class": {
          "name": "X",
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
                  "name": "prop1",
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
                                      "start": 319,
                                      "end": 320
                                    }
                                  }
                                },
                                "span": {
                                  "start": 319,
                                  "end": 320
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
                                      "start": 321,
                                      "end": 322
                                    }
                                  }
                                },
                                "span": {
                                  "start": 321,
                                  "end": 322
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 318,
                            "end": 323
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
                                      "start": 325,
                                      "end": 326
                                    }
                                  }
                                },
                                "span": {
                                  "start": 325,
                                  "end": 326
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
                                      "start": 327,
                                      "end": 328
                                    }
                                  }
                                },
                                "span": {
                                  "start": 327,
                                  "end": 328
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 324,
                            "end": 329
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 318,
                      "end": 329
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 311,
                "end": 336
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "prop2",
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
                                      "start": 350,
                                      "end": 351
                                    }
                                  }
                                },
                                "span": {
                                  "start": 350,
                                  "end": 351
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
                                      "start": 352,
                                      "end": 353
                                    }
                                  }
                                },
                                "span": {
                                  "start": 352,
                                  "end": 353
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 349,
                            "end": 354
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
                                      "start": 356,
                                      "end": 357
                                    }
                                  }
                                },
                                "span": {
                                  "start": 356,
                                  "end": 357
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
                                      "start": 358,
                                      "end": 359
                                    }
                                  }
                                },
                                "span": {
                                  "start": 358,
                                  "end": 359
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 355,
                            "end": 360
                          }
                        },
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "E"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 362,
                                      "end": 363
                                    }
                                  }
                                },
                                "span": {
                                  "start": 362,
                                  "end": 363
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "F"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 364,
                                      "end": 365
                                    }
                                  }
                                },
                                "span": {
                                  "start": 364,
                                  "end": 365
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 361,
                            "end": 366
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 349,
                      "end": 366
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 342,
                "end": 373
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 297,
        "end": 376
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 376
  }
}

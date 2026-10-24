===source===
<?php
namespace N {
    use X\A as B;
    use X\{C, D as E};
    function a(): \N\F|F {}
    function b(): namespace\G|G {}
    function c(): \X\A|B {}
    function d(): C|\X\C {}
    function e(): \X\D|E {}
    function f(): iterable|\Traversable {}
    class K extends B {
        public function g(): K|self {}
        public function h(): parent|\X\A {}
    }
}
namespace {
    function i(): \Foo|Foo {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type 'F' in union type
'union types' requires PHP 8.0 or higher
Duplicate type 'G' in union type
'union types' requires PHP 8.0 or higher
Duplicate type 'B' in union type
'union types' requires PHP 8.0 or higher
Duplicate type '\X\C' in union type
'union types' requires PHP 8.0 or higher
Duplicate type 'E' in union type
'union types' requires PHP 8.0 or higher
Duplicate type '\Traversable' in union type
'union types' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
Duplicate type 'Foo' in union type
===errors 8.0-8.4===
Duplicate type 'F' in union type
Duplicate type 'G' in union type
Duplicate type 'B' in union type
Duplicate type '\X\C' in union type
Duplicate type 'E' in union type
Duplicate type '\Traversable' in union type
Duplicate type 'Foo' in union type
===errors >=8.5===
Duplicate type 'F' in union type
Duplicate type 'G' in union type
Duplicate type 'B' in union type
Duplicate type '\X\C' in union type
Duplicate type 'E' in union type
Duplicate type '\Traversable' in union type
Duplicate type 'self' in union type
Duplicate type '\X\A' in union type
Duplicate type 'Foo' in union type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '{' in Standard input code on line 5
===php_error >=8.0===
PHP Fatal error:  Duplicate type N\F is redundant in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "X",
                            "A"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 28,
                            "end": 31
                          }
                        },
                        "alias": {
                          "name": "B",
                          "span": {
                            "start": 35,
                            "end": 36
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 36
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 24,
                  "end": 37
                }
              },
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "X",
                            "C"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 49,
                            "end": 50
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 49,
                          "end": 50
                        }
                      },
                      {
                        "name": {
                          "parts": [
                            "X",
                            "D"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 52,
                            "end": 53
                          }
                        },
                        "alias": {
                          "name": "E",
                          "span": {
                            "start": 57,
                            "end": 58
                          }
                        },
                        "span": {
                          "start": 52,
                          "end": 58
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 42,
                  "end": 60
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 74,
                        "end": 75
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
                                  "N",
                                  "F"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 79,
                                  "end": 83
                                }
                              }
                            },
                            "span": {
                              "start": 79,
                              "end": 83
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
                                  "start": 84,
                                  "end": 85
                                }
                              }
                            },
                            "span": {
                              "start": 84,
                              "end": 85
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 79,
                        "end": 85
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 65,
                  "end": 88
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 102,
                        "end": 103
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
                                  "G"
                                ],
                                "kind": "Relative",
                                "span": {
                                  "start": 107,
                                  "end": 118
                                }
                              }
                            },
                            "span": {
                              "start": 107,
                              "end": 118
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
                                  "start": 119,
                                  "end": 120
                                }
                              }
                            },
                            "span": {
                              "start": 119,
                              "end": 120
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 107,
                        "end": 120
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 93,
                  "end": 123
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "c",
                      "span": {
                        "start": 137,
                        "end": 138
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
                                  "X",
                                  "A"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 142,
                                  "end": 146
                                }
                              }
                            },
                            "span": {
                              "start": 142,
                              "end": 146
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
                                  "start": 147,
                                  "end": 148
                                }
                              }
                            },
                            "span": {
                              "start": 147,
                              "end": 148
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 142,
                        "end": 148
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 128,
                  "end": 151
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "d",
                      "span": {
                        "start": 165,
                        "end": 166
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
                                  "C"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 170,
                                  "end": 171
                                }
                              }
                            },
                            "span": {
                              "start": 170,
                              "end": 171
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "X",
                                  "C"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 172,
                                  "end": 176
                                }
                              }
                            },
                            "span": {
                              "start": 172,
                              "end": 176
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 170,
                        "end": 176
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 156,
                  "end": 179
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "e",
                      "span": {
                        "start": 193,
                        "end": 194
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
                                  "X",
                                  "D"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 198,
                                  "end": 202
                                }
                              }
                            },
                            "span": {
                              "start": 198,
                              "end": 202
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 203,
                                  "end": 204
                                }
                              }
                            },
                            "span": {
                              "start": 203,
                              "end": 204
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 198,
                        "end": 204
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 184,
                  "end": 207
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 221,
                        "end": 222
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
                                  "iterable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 226,
                                  "end": 234
                                }
                              }
                            },
                            "span": {
                              "start": 226,
                              "end": 234
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Traversable"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 235,
                                  "end": 247
                                }
                              }
                            },
                            "span": {
                              "start": 235,
                              "end": 247
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 226,
                        "end": 247
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 212,
                  "end": 250
                }
              },
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "K",
                      "span": {
                        "start": 261,
                        "end": 262
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 271,
                        "end": 272
                      }
                    },
                    "implements": [],
                    "members": [
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "g",
                              "span": {
                                "start": 299,
                                "end": 300
                              }
                            },
                            "modifiers": {
                              "visibility": "Public"
                            },
                            "by_ref": false,
                            "params": [],
                            "return_type": {
                              "kind": {
                                "Union": [
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "K"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 304,
                                          "end": 305
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 304,
                                      "end": 305
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "self"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 306,
                                          "end": 310
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 306,
                                      "end": 310
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 304,
                                "end": 310
                              }
                            },
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 283,
                          "end": 313
                        }
                      },
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "h",
                              "span": {
                                "start": 338,
                                "end": 339
                              }
                            },
                            "modifiers": {
                              "visibility": "Public"
                            },
                            "by_ref": false,
                            "params": [],
                            "return_type": {
                              "kind": {
                                "Union": [
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "parent"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 343,
                                          "end": 349
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 343,
                                      "end": 349
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "X",
                                          "A"
                                        ],
                                        "kind": "FullyQualified",
                                        "span": {
                                          "start": 350,
                                          "end": 354
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 350,
                                      "end": 354
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 343,
                                "end": 354
                              }
                            },
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 322,
                          "end": 357
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 255,
                  "end": 363
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 365
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "i",
                      "span": {
                        "start": 391,
                        "end": 392
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
                                  "Foo"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 396,
                                  "end": 400
                                }
                              }
                            },
                            "span": {
                              "start": 396,
                              "end": 400
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 401,
                                  "end": 404
                                }
                              }
                            },
                            "span": {
                              "start": 401,
                              "end": 404
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 396,
                        "end": 404
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 382,
                  "end": 407
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 366,
        "end": 409
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 409
  }
}

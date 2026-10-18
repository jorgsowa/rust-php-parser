===source===
<?php
function a(): Foo|FOO {}
function b(): Foo&A&FOO {}
function c(): bool|true {}
function d(): iterable|array {}
function e(): (A&B)|(B&A) {}
function f(int|string $x, ?Foo $y): (A&B)|(A&C)|null {}
===errors===
Duplicate type 'FOO' in union type
Duplicate type 'FOO' in intersection type
Duplicate type 'true' in union type
Duplicate type 'array' in union type
Duplicate type '(B&A)' in union type
===php_error===
PHP Fatal error:  Duplicate type FOO is redundant in Standard input code on line 2
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
                        "Foo"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "FOO"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 24,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 24,
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
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Foo"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 45,
                        "end": 48
                      }
                    }
                  },
                  "span": {
                    "start": 45,
                    "end": 48
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
                        "start": 49,
                        "end": 50
                      }
                    }
                  },
                  "span": {
                    "start": 49,
                    "end": 50
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "FOO"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 51,
                        "end": 54
                      }
                    }
                  },
                  "span": {
                    "start": 51,
                    "end": 54
                  }
                }
              ]
            },
            "span": {
              "start": 45,
              "end": 54
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 31,
        "end": 57
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 67,
              "end": 68
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
                        "bool"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 72,
                        "end": 76
                      }
                    }
                  },
                  "span": {
                    "start": 72,
                    "end": 76
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "true"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 77,
                        "end": 81
                      }
                    }
                  },
                  "span": {
                    "start": 77,
                    "end": 81
                  }
                }
              ]
            },
            "span": {
              "start": 72,
              "end": 81
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 58,
        "end": 84
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
            "span": {
              "start": 94,
              "end": 95
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
                        "start": 99,
                        "end": 107
                      }
                    }
                  },
                  "span": {
                    "start": 99,
                    "end": 107
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "array"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 108,
                        "end": 113
                      }
                    }
                  },
                  "span": {
                    "start": 108,
                    "end": 113
                  }
                }
              ]
            },
            "span": {
              "start": 99,
              "end": 113
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 85,
        "end": 116
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "e",
            "span": {
              "start": 126,
              "end": 127
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
                              "start": 132,
                              "end": 133
                            }
                          }
                        },
                        "span": {
                          "start": 132,
                          "end": 133
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
                              "start": 134,
                              "end": 135
                            }
                          }
                        },
                        "span": {
                          "start": 134,
                          "end": 135
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 131,
                    "end": 136
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
                              "start": 138,
                              "end": 139
                            }
                          }
                        },
                        "span": {
                          "start": 138,
                          "end": 139
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
                              "start": 140,
                              "end": 141
                            }
                          }
                        },
                        "span": {
                          "start": 140,
                          "end": 141
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 137,
                    "end": 142
                  }
                }
              ]
            },
            "span": {
              "start": 131,
              "end": 142
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 117,
        "end": 145
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 155,
              "end": 156
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 168,
                  "end": 170
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 157,
                            "end": 160
                          }
                        }
                      },
                      "span": {
                        "start": 157,
                        "end": 160
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 161,
                            "end": 167
                          }
                        }
                      },
                      "span": {
                        "start": 161,
                        "end": 167
                      }
                    }
                  ]
                },
                "span": {
                  "start": 157,
                  "end": 167
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
                "start": 157,
                "end": 170
              }
            },
            {
              "name": {
                "name": "y",
                "span": {
                  "start": 177,
                  "end": 179
                }
              },
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 173,
                          "end": 176
                        }
                      }
                    },
                    "span": {
                      "start": 173,
                      "end": 176
                    }
                  }
                },
                "span": {
                  "start": 172,
                  "end": 176
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
                "start": 172,
                "end": 179
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
                              "start": 183,
                              "end": 184
                            }
                          }
                        },
                        "span": {
                          "start": 183,
                          "end": 184
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
                              "start": 185,
                              "end": 186
                            }
                          }
                        },
                        "span": {
                          "start": 185,
                          "end": 186
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 182,
                    "end": 187
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
                              "start": 189,
                              "end": 190
                            }
                          }
                        },
                        "span": {
                          "start": 189,
                          "end": 190
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
                              "start": 191,
                              "end": 192
                            }
                          }
                        },
                        "span": {
                          "start": 191,
                          "end": 192
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 188,
                    "end": 193
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
                        "start": 194,
                        "end": 198
                      }
                    }
                  },
                  "span": {
                    "start": 194,
                    "end": 198
                  }
                }
              ]
            },
            "span": {
              "start": 182,
              "end": 198
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 146,
        "end": 201
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 201
  }
}

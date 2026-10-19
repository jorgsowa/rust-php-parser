===config===
min_php=8.1

===source===
<?php
function a(?void $a): ?never {}
function b(): void|null {}
function c(): never|int {}
function d(): mixed|int {}
function e(): ?null {}
class C {
    public ?void $p;
    public function m(): void|false {}
}
$f = fn(): ?void => 1;
===errors===
Void can only be used as a standalone type
never can only be used as a standalone type
Void can only be used as a standalone type
never can only be used as a standalone type
Type mixed can only be used as a standalone type
null cannot be marked as nullable
Void can only be used as a standalone type
Void can only be used as a standalone type
Void can only be used as a standalone type
===php_error===
PHP Fatal error:  never can only be used as a standalone type in Standard input code on line 2
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
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 23,
                  "end": 25
                }
              },
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 18,
                          "end": 22
                        }
                      }
                    },
                    "span": {
                      "start": 18,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 22
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 25
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "never"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 34
                }
              }
            },
            "span": {
              "start": 28,
              "end": 34
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 47,
              "end": 48
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
                        "void"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 52,
                        "end": 56
                      }
                    }
                  },
                  "span": {
                    "start": 52,
                    "end": 56
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
                        "start": 57,
                        "end": 61
                      }
                    }
                  },
                  "span": {
                    "start": 57,
                    "end": 61
                  }
                }
              ]
            },
            "span": {
              "start": 52,
              "end": 61
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 38,
        "end": 64
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
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
                        "never"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 79,
                        "end": 84
                      }
                    }
                  },
                  "span": {
                    "start": 79,
                    "end": 84
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 85,
                        "end": 88
                      }
                    }
                  },
                  "span": {
                    "start": 85,
                    "end": 88
                  }
                }
              ]
            },
            "span": {
              "start": 79,
              "end": 88
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 65,
        "end": 91
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
            "span": {
              "start": 101,
              "end": 102
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
                        "mixed"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 106,
                        "end": 111
                      }
                    }
                  },
                  "span": {
                    "start": 106,
                    "end": 111
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 112,
                        "end": 115
                      }
                    }
                  },
                  "span": {
                    "start": 112,
                    "end": 115
                  }
                }
              ]
            },
            "span": {
              "start": 106,
              "end": 115
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 92,
        "end": 118
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "e",
            "span": {
              "start": 128,
              "end": 129
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "null"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 134,
                      "end": 138
                    }
                  }
                },
                "span": {
                  "start": 134,
                  "end": 138
                }
              }
            },
            "span": {
              "start": 133,
              "end": 138
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 119,
        "end": 141
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 148,
              "end": 149
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
                    "name": "p",
                    "span": {
                      "start": 169,
                      "end": 171
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "void"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 164,
                              "end": 168
                            }
                          }
                        },
                        "span": {
                          "start": 164,
                          "end": 168
                        }
                      }
                    },
                    "span": {
                      "start": 163,
                      "end": 168
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 156,
                "end": 171
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 193,
                      "end": 194
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
                                "void"
                              ],
                              "kind": "Unqualified",
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
                                "false"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 203,
                                "end": 208
                              }
                            }
                          },
                          "span": {
                            "start": 203,
                            "end": 208
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 198,
                      "end": 208
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 177,
                "end": 211
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 142,
        "end": 213
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 214,
                  "end": 216
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": {
                      "kind": {
                        "Nullable": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 226,
                                "end": 230
                              }
                            }
                          },
                          "span": {
                            "start": 226,
                            "end": 230
                          }
                        }
                      },
                      "span": {
                        "start": 225,
                        "end": 230
                      }
                    },
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 234,
                        "end": 235
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 219,
                  "end": 235
                }
              }
            }
          },
          "span": {
            "start": 214,
            "end": 235
          }
        }
      },
      "span": {
        "start": 214,
        "end": 236
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 236
  }
}

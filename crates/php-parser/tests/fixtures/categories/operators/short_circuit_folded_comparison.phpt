===source===
<?php
1 > 2 && isset(1 + 1);
1 < 2 || isset(1 + 1);
PHP_EOL !== 1 || isset(1 + 1);
"a" . "b" === "ab" || 1 > 2 && isset(1 + 1);
const A = 1 > 2 && $a;
const B = 'a' < 'b' || $b;
class C {
    const Y = __CLASS__ === 'C' || $c;
    function f() {
        __CLASS__ || isset(1 + 1);
        $g = fn($p = __CLASS__ == 'D' && $d) => $p;
    }
}
function f() {
    __CLASS__ && isset(1 + 1);
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 6,
                        "end": 7
                      }
                    },
                    "op": "Greater",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 10,
                        "end": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "BooleanAnd",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 21,
                              "end": 22
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 25,
                              "end": 26
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 26
                      }
                    }
                  ]
                },
                "span": {
                  "start": 15,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 33,
                        "end": 34
                      }
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 34
                }
              },
              "op": "BooleanOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 44,
                              "end": 45
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 48,
                              "end": 49
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 44,
                        "end": 49
                      }
                    }
                  ]
                },
                "span": {
                  "start": 38,
                  "end": 50
                }
              }
            }
          },
          "span": {
            "start": 29,
            "end": 50
          }
        }
      },
      "span": {
        "start": 29,
        "end": 51
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "PHP_EOL"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 52,
                            "end": 59
                          }
                        }
                      },
                      "span": {
                        "start": 52,
                        "end": 59
                      }
                    },
                    "op": "NotIdentical",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 64,
                        "end": 65
                      }
                    }
                  }
                },
                "span": {
                  "start": 52,
                  "end": 65
                }
              },
              "op": "BooleanOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 75,
                              "end": 76
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 79,
                              "end": 80
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 75,
                        "end": 80
                      }
                    }
                  ]
                },
                "span": {
                  "start": 69,
                  "end": 81
                }
              }
            }
          },
          "span": {
            "start": 52,
            "end": 81
          }
        }
      },
      "span": {
        "start": 52,
        "end": 82
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "String": "a"
                            },
                            "span": {
                              "start": 83,
                              "end": 86
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 89,
                              "end": 92
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 83,
                        "end": 92
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "String": "ab"
                      },
                      "span": {
                        "start": 97,
                        "end": 101
                      }
                    }
                  }
                },
                "span": {
                  "start": 83,
                  "end": 101
                }
              },
              "op": "BooleanOr",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 105,
                              "end": 106
                            }
                          },
                          "op": "Greater",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 109,
                              "end": 110
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 105,
                        "end": 110
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Isset": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 120,
                                    "end": 121
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 124,
                                    "end": 125
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 120,
                              "end": 125
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 114,
                        "end": 126
                      }
                    }
                  }
                },
                "span": {
                  "start": 105,
                  "end": 126
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 126
          }
        }
      },
      "span": {
        "start": 83,
        "end": 127
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 134,
                "end": 135
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 138,
                            "end": 139
                          }
                        },
                        "op": "Greater",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 142,
                            "end": 143
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 138,
                      "end": 143
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 147,
                      "end": 149
                    }
                  }
                }
              },
              "span": {
                "start": 138,
                "end": 149
              }
            },
            "attributes": [],
            "span": {
              "start": 134,
              "end": 149
            }
          }
        ]
      },
      "span": {
        "start": 128,
        "end": 150
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 157,
                "end": 158
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 161,
                            "end": 164
                          }
                        },
                        "op": "Less",
                        "right": {
                          "kind": {
                            "String": "b"
                          },
                          "span": {
                            "start": 167,
                            "end": 170
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 161,
                      "end": 170
                    }
                  },
                  "op": "BooleanOr",
                  "right": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 174,
                      "end": 176
                    }
                  }
                }
              },
              "span": {
                "start": 161,
                "end": 176
              }
            },
            "attributes": [],
            "span": {
              "start": 157,
              "end": 176
            }
          }
        ]
      },
      "span": {
        "start": 151,
        "end": 177
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 184,
              "end": 185
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
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 198,
                      "end": 199
                    }
                  },
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "MagicConst": "Class"
                                },
                                "span": {
                                  "start": 202,
                                  "end": 211
                                }
                              },
                              "op": "Identical",
                              "right": {
                                "kind": {
                                  "String": "C"
                                },
                                "span": {
                                  "start": 216,
                                  "end": 219
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 202,
                            "end": 219
                          }
                        },
                        "op": "BooleanOr",
                        "right": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 223,
                            "end": 225
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 202,
                      "end": 225
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 192,
                "end": 226
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 240,
                      "end": 241
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "MagicConst": "Class"
                                },
                                "span": {
                                  "start": 254,
                                  "end": 263
                                }
                              },
                              "op": "BooleanOr",
                              "right": {
                                "kind": {
                                  "Isset": [
                                    {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 273,
                                              "end": 274
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 277,
                                              "end": 278
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 273,
                                        "end": 278
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 267,
                                  "end": 279
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 254,
                            "end": 279
                          }
                        }
                      },
                      "span": {
                        "start": 254,
                        "end": 280
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "g"
                                },
                                "span": {
                                  "start": 289,
                                  "end": 291
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "ArrowFunction": {
                                    "is_static": false,
                                    "by_ref": false,
                                    "params": [
                                      {
                                        "name": {
                                          "name": "p",
                                          "span": {
                                            "start": 297,
                                            "end": 299
                                          }
                                        },
                                        "type_hint": null,
                                        "default": {
                                          "kind": {
                                            "Binary": {
                                              "left": {
                                                "kind": {
                                                  "Binary": {
                                                    "left": {
                                                      "kind": {
                                                        "MagicConst": "Class"
                                                      },
                                                      "span": {
                                                        "start": 302,
                                                        "end": 311
                                                      }
                                                    },
                                                    "op": "Equal",
                                                    "right": {
                                                      "kind": {
                                                        "String": "D"
                                                      },
                                                      "span": {
                                                        "start": 315,
                                                        "end": 318
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 302,
                                                  "end": 318
                                                }
                                              },
                                              "op": "BooleanAnd",
                                              "right": {
                                                "kind": {
                                                  "Variable": "d"
                                                },
                                                "span": {
                                                  "start": 322,
                                                  "end": 324
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 302,
                                            "end": 324
                                          }
                                        },
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 297,
                                          "end": 324
                                        }
                                      }
                                    ],
                                    "return_type": null,
                                    "body": {
                                      "kind": {
                                        "Variable": "p"
                                      },
                                      "span": {
                                        "start": 329,
                                        "end": 331
                                      }
                                    },
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 294,
                                  "end": 331
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 289,
                            "end": 331
                          }
                        }
                      },
                      "span": {
                        "start": 289,
                        "end": 332
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 231,
                "end": 338
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 178,
        "end": 340
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 350,
              "end": 351
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "MagicConst": "Class"
                        },
                        "span": {
                          "start": 360,
                          "end": 369
                        }
                      },
                      "op": "BooleanAnd",
                      "right": {
                        "kind": {
                          "Isset": [
                            {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 379,
                                      "end": 380
                                    }
                                  },
                                  "op": "Add",
                                  "right": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 383,
                                      "end": 384
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 379,
                                "end": 384
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 373,
                          "end": 385
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 360,
                    "end": 385
                  }
                }
              },
              "span": {
                "start": 360,
                "end": 386
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 341,
        "end": 388
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 388
  }
}

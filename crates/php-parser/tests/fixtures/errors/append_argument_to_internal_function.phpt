===source===
<?php
namespace {
    strlen($a[]);
    \STRLEN($a[]);
    preg_match($p, $s[], $m);
    array_push($a[], $b[]);
    sprintf('%s', $a[]);
    str_contains($a[], 'x');
    strlen(...$a[]);
    sort($a[]);
    preg_match($p, $s, $m[]);
    sscanf($s, $f, $a[], $b[]);
    array_multisort($a[], $b[]);
    each($a[]);
}
namespace A {
    \json_encode($a[]);
    strlen($a[]);
    namespace\strlen($a[]);
}
===errors <=7.4===
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
===errors >=8.0===
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "strlen"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 22,
                                "end": 28
                              }
                            }
                          },
                          "span": {
                            "start": 22,
                            "end": 28
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 29,
                                        "end": 31
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 29,
                                  "end": 33
                                }
                              }
                            },
                            "span": {
                              "start": 29,
                              "end": 33
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 34
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 35
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "STRLEN"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 40,
                                "end": 47
                              }
                            }
                          },
                          "span": {
                            "start": 40,
                            "end": 47
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 48,
                                        "end": 50
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 48,
                                  "end": 52
                                }
                              }
                            },
                            "span": {
                              "start": 48,
                              "end": 52
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 53
                    }
                  }
                },
                "span": {
                  "start": 40,
                  "end": 54
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "preg_match"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 59,
                                "end": 69
                              }
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 69
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "p"
                                },
                                "span": {
                                  "start": 70,
                                  "end": 72
                                }
                              }
                            },
                            "span": {
                              "start": 70,
                              "end": 72
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "s"
                                      },
                                      "span": {
                                        "start": 74,
                                        "end": 76
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 74,
                                  "end": 78
                                }
                              }
                            },
                            "span": {
                              "start": 74,
                              "end": 78
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "m"
                                },
                                "span": {
                                  "start": 80,
                                  "end": 82
                                }
                              }
                            },
                            "span": {
                              "start": 80,
                              "end": 82
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 83
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 84
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "array_push"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 89,
                                "end": 99
                              }
                            }
                          },
                          "span": {
                            "start": 89,
                            "end": 99
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 100,
                                        "end": 102
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 100,
                                  "end": 104
                                }
                              }
                            },
                            "span": {
                              "start": 100,
                              "end": 104
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "b"
                                      },
                                      "span": {
                                        "start": 106,
                                        "end": 108
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 106,
                                  "end": 110
                                }
                              }
                            },
                            "span": {
                              "start": 106,
                              "end": 110
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 89,
                      "end": 111
                    }
                  }
                },
                "span": {
                  "start": 89,
                  "end": 112
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "sprintf"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 117,
                                "end": 124
                              }
                            }
                          },
                          "span": {
                            "start": 117,
                            "end": 124
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "String": "%s"
                                },
                                "span": {
                                  "start": 125,
                                  "end": 129
                                }
                              }
                            },
                            "span": {
                              "start": 125,
                              "end": 129
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 131,
                                        "end": 133
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 131,
                                  "end": 135
                                }
                              }
                            },
                            "span": {
                              "start": 131,
                              "end": 135
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 117,
                      "end": 136
                    }
                  }
                },
                "span": {
                  "start": 117,
                  "end": 137
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "str_contains"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 142,
                                "end": 154
                              }
                            }
                          },
                          "span": {
                            "start": 142,
                            "end": 154
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 155,
                                        "end": 157
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 155,
                                  "end": 159
                                }
                              }
                            },
                            "span": {
                              "start": 155,
                              "end": 159
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "String": "x"
                                },
                                "span": {
                                  "start": 161,
                                  "end": 164
                                }
                              }
                            },
                            "span": {
                              "start": 161,
                              "end": 164
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 142,
                      "end": 165
                    }
                  }
                },
                "span": {
                  "start": 142,
                  "end": 166
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "strlen"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 171,
                                "end": 177
                              }
                            }
                          },
                          "span": {
                            "start": 171,
                            "end": 177
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Spread": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 181,
                                        "end": 183
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 181,
                                  "end": 185
                                }
                              }
                            },
                            "span": {
                              "start": 178,
                              "end": 185
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 171,
                      "end": 186
                    }
                  }
                },
                "span": {
                  "start": 171,
                  "end": 187
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "sort"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 192,
                                "end": 196
                              }
                            }
                          },
                          "span": {
                            "start": 192,
                            "end": 196
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 197,
                                        "end": 199
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 197,
                                  "end": 201
                                }
                              }
                            },
                            "span": {
                              "start": 197,
                              "end": 201
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 192,
                      "end": 202
                    }
                  }
                },
                "span": {
                  "start": 192,
                  "end": 203
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "preg_match"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 208,
                                "end": 218
                              }
                            }
                          },
                          "span": {
                            "start": 208,
                            "end": 218
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "p"
                                },
                                "span": {
                                  "start": 219,
                                  "end": 221
                                }
                              }
                            },
                            "span": {
                              "start": 219,
                              "end": 221
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "s"
                                },
                                "span": {
                                  "start": 223,
                                  "end": 225
                                }
                              }
                            },
                            "span": {
                              "start": 223,
                              "end": 225
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "m"
                                      },
                                      "span": {
                                        "start": 227,
                                        "end": 229
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 227,
                                  "end": 231
                                }
                              }
                            },
                            "span": {
                              "start": 227,
                              "end": 231
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 208,
                      "end": 232
                    }
                  }
                },
                "span": {
                  "start": 208,
                  "end": 233
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "sscanf"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 238,
                                "end": 244
                              }
                            }
                          },
                          "span": {
                            "start": 238,
                            "end": 244
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "s"
                                },
                                "span": {
                                  "start": 245,
                                  "end": 247
                                }
                              }
                            },
                            "span": {
                              "start": 245,
                              "end": 247
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "f"
                                },
                                "span": {
                                  "start": 249,
                                  "end": 251
                                }
                              }
                            },
                            "span": {
                              "start": 249,
                              "end": 251
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 253,
                                        "end": 255
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 253,
                                  "end": 257
                                }
                              }
                            },
                            "span": {
                              "start": 253,
                              "end": 257
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "b"
                                      },
                                      "span": {
                                        "start": 259,
                                        "end": 261
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 259,
                                  "end": 263
                                }
                              }
                            },
                            "span": {
                              "start": 259,
                              "end": 263
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 238,
                      "end": 264
                    }
                  }
                },
                "span": {
                  "start": 238,
                  "end": 265
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "array_multisort"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 270,
                                "end": 285
                              }
                            }
                          },
                          "span": {
                            "start": 270,
                            "end": 285
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 286,
                                        "end": 288
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 286,
                                  "end": 290
                                }
                              }
                            },
                            "span": {
                              "start": 286,
                              "end": 290
                            }
                          },
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "b"
                                      },
                                      "span": {
                                        "start": 292,
                                        "end": 294
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 292,
                                  "end": 296
                                }
                              }
                            },
                            "span": {
                              "start": 292,
                              "end": 296
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 270,
                      "end": 297
                    }
                  }
                },
                "span": {
                  "start": 270,
                  "end": 298
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "each"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 303,
                                "end": 307
                              }
                            }
                          },
                          "span": {
                            "start": 303,
                            "end": 307
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 308,
                                        "end": 310
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 308,
                                  "end": 312
                                }
                              }
                            },
                            "span": {
                              "start": 308,
                              "end": 312
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 303,
                      "end": 313
                    }
                  }
                },
                "span": {
                  "start": 303,
                  "end": 314
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 316
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 327,
              "end": 328
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "json_encode"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 335,
                                "end": 347
                              }
                            }
                          },
                          "span": {
                            "start": 335,
                            "end": 347
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 348,
                                        "end": 350
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 348,
                                  "end": 352
                                }
                              }
                            },
                            "span": {
                              "start": 348,
                              "end": 352
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 335,
                      "end": 353
                    }
                  }
                },
                "span": {
                  "start": 335,
                  "end": 354
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "strlen"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 359,
                                "end": 365
                              }
                            }
                          },
                          "span": {
                            "start": 359,
                            "end": 365
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 366,
                                        "end": 368
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 366,
                                  "end": 370
                                }
                              }
                            },
                            "span": {
                              "start": 366,
                              "end": 370
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 359,
                      "end": 371
                    }
                  }
                },
                "span": {
                  "start": 359,
                  "end": 372
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "strlen"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 377,
                                "end": 393
                              }
                            }
                          },
                          "span": {
                            "start": 377,
                            "end": 393
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 394,
                                        "end": 396
                                      }
                                    },
                                    "index": null
                                  }
                                },
                                "span": {
                                  "start": 394,
                                  "end": 398
                                }
                              }
                            },
                            "span": {
                              "start": 394,
                              "end": 398
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 377,
                      "end": 399
                    }
                  }
                },
                "span": {
                  "start": 377,
                  "end": 400
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 317,
        "end": 402
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 402
  }
}

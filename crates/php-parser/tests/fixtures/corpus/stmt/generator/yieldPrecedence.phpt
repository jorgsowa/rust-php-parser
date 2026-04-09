===source===
<?php

function gen() {
    yield "a" . "b";
    yield "a" or die;
    yield "k" => "a" . "b";
    yield "k" => "a" or die;
    var_dump([yield "k" => "a" . "b"]);
    yield yield "k1" => yield "k2" => "a" . "b";
    yield yield "k1" => (yield "k2") => "a" . "b";
    var_dump([yield "k1" => yield "k2" => "a" . "b"]);
    var_dump([yield "k1" => (yield "k2") => "a" . "b"]);
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 34,
                                "end": 37,
                                "start_line": 4,
                                "start_col": 10
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 40,
                                "end": 43,
                                "start_line": 4,
                                "start_col": 16
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 43,
                          "start_line": 4,
                          "start_col": 10
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 43,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 49,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 55,
                                "end": 58,
                                "start_line": 5,
                                "start_col": 10
                              }
                            },
                            "op": "LogicalOr",
                            "right": {
                              "kind": {
                                "Exit": null
                              },
                              "span": {
                                "start": 62,
                                "end": 65,
                                "start_line": 5,
                                "start_col": 17
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 55,
                          "end": 65,
                          "start_line": 5,
                          "start_col": 10
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 49,
                    "end": 65,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 71,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 77,
                          "end": 80,
                          "start_line": 6,
                          "start_col": 10
                        }
                      },
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 84,
                                "end": 87,
                                "start_line": 6,
                                "start_col": 17
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 90,
                                "end": 93,
                                "start_line": 6,
                                "start_col": 23
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 84,
                          "end": 93,
                          "start_line": 6,
                          "start_col": 17
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 71,
                    "end": 93,
                    "start_line": 6,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 71,
                "end": 99,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 105,
                          "end": 108,
                          "start_line": 7,
                          "start_col": 10
                        }
                      },
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 112,
                                "end": 115,
                                "start_line": 7,
                                "start_col": 17
                              }
                            },
                            "op": "LogicalOr",
                            "right": {
                              "kind": {
                                "Exit": null
                              },
                              "span": {
                                "start": 119,
                                "end": 122,
                                "start_line": 7,
                                "start_col": 24
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 112,
                          "end": 122,
                          "start_line": 7,
                          "start_col": 17
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 99,
                    "end": 122,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 99,
                "end": 128,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "var_dump"
                        },
                        "span": {
                          "start": 128,
                          "end": 136,
                          "start_line": 8,
                          "start_col": 4
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Array": [
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Yield": {
                                        "key": {
                                          "kind": {
                                            "String": "k"
                                          },
                                          "span": {
                                            "start": 144,
                                            "end": 147,
                                            "start_line": 8,
                                            "start_col": 20
                                          }
                                        },
                                        "value": {
                                          "kind": {
                                            "Binary": {
                                              "left": {
                                                "kind": {
                                                  "String": "a"
                                                },
                                                "span": {
                                                  "start": 151,
                                                  "end": 154,
                                                  "start_line": 8,
                                                  "start_col": 27
                                                }
                                              },
                                              "op": "Concat",
                                              "right": {
                                                "kind": {
                                                  "String": "b"
                                                },
                                                "span": {
                                                  "start": 157,
                                                  "end": 160,
                                                  "start_line": 8,
                                                  "start_col": 33
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 151,
                                            "end": 160,
                                            "start_line": 8,
                                            "start_col": 27
                                          }
                                        },
                                        "is_from": false
                                      }
                                    },
                                    "span": {
                                      "start": 138,
                                      "end": 160,
                                      "start_line": 8,
                                      "start_col": 14
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 138,
                                    "end": 160,
                                    "start_line": 8,
                                    "start_col": 14
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 137,
                              "end": 161,
                              "start_line": 8,
                              "start_col": 13
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 137,
                            "end": 161,
                            "start_line": 8,
                            "start_col": 13
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 128,
                    "end": 162,
                    "start_line": 8,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 128,
                "end": 168,
                "start_line": 8,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Yield": {
                            "key": {
                              "kind": {
                                "String": "k1"
                              },
                              "span": {
                                "start": 180,
                                "end": 184,
                                "start_line": 9,
                                "start_col": 16
                              }
                            },
                            "value": {
                              "kind": {
                                "Yield": {
                                  "key": {
                                    "kind": {
                                      "String": "k2"
                                    },
                                    "span": {
                                      "start": 194,
                                      "end": 198,
                                      "start_line": 9,
                                      "start_col": 30
                                    }
                                  },
                                  "value": {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "String": "a"
                                          },
                                          "span": {
                                            "start": 202,
                                            "end": 205,
                                            "start_line": 9,
                                            "start_col": 38
                                          }
                                        },
                                        "op": "Concat",
                                        "right": {
                                          "kind": {
                                            "String": "b"
                                          },
                                          "span": {
                                            "start": 208,
                                            "end": 211,
                                            "start_line": 9,
                                            "start_col": 44
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 202,
                                      "end": 211,
                                      "start_line": 9,
                                      "start_col": 38
                                    }
                                  },
                                  "is_from": false
                                }
                              },
                              "span": {
                                "start": 188,
                                "end": 211,
                                "start_line": 9,
                                "start_col": 24
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 174,
                          "end": 211,
                          "start_line": 9,
                          "start_col": 10
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 168,
                    "end": 211,
                    "start_line": 9,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 168,
                "end": 217,
                "start_line": 9,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": {
                        "kind": {
                          "Yield": {
                            "key": {
                              "kind": {
                                "String": "k1"
                              },
                              "span": {
                                "start": 229,
                                "end": 233,
                                "start_line": 10,
                                "start_col": 16
                              }
                            },
                            "value": {
                              "kind": {
                                "Parenthesized": {
                                  "kind": {
                                    "Yield": {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "String": "k2"
                                        },
                                        "span": {
                                          "start": 244,
                                          "end": 248,
                                          "start_line": 10,
                                          "start_col": 31
                                        }
                                      },
                                      "is_from": false
                                    }
                                  },
                                  "span": {
                                    "start": 238,
                                    "end": 248,
                                    "start_line": 10,
                                    "start_col": 25
                                  }
                                }
                              },
                              "span": {
                                "start": 237,
                                "end": 250,
                                "start_line": 10,
                                "start_col": 24
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 223,
                          "end": 250,
                          "start_line": 10,
                          "start_col": 10
                        }
                      },
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 253,
                                "end": 256,
                                "start_line": 10,
                                "start_col": 40
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 259,
                                "end": 262,
                                "start_line": 10,
                                "start_col": 46
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 253,
                          "end": 262,
                          "start_line": 10,
                          "start_col": 40
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 217,
                    "end": 262,
                    "start_line": 10,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 217,
                "end": 268,
                "start_line": 10,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "var_dump"
                        },
                        "span": {
                          "start": 268,
                          "end": 276,
                          "start_line": 11,
                          "start_col": 4
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Array": [
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Yield": {
                                        "key": {
                                          "kind": {
                                            "String": "k1"
                                          },
                                          "span": {
                                            "start": 284,
                                            "end": 288,
                                            "start_line": 11,
                                            "start_col": 20
                                          }
                                        },
                                        "value": {
                                          "kind": {
                                            "Yield": {
                                              "key": {
                                                "kind": {
                                                  "String": "k2"
                                                },
                                                "span": {
                                                  "start": 298,
                                                  "end": 302,
                                                  "start_line": 11,
                                                  "start_col": 34
                                                }
                                              },
                                              "value": {
                                                "kind": {
                                                  "Binary": {
                                                    "left": {
                                                      "kind": {
                                                        "String": "a"
                                                      },
                                                      "span": {
                                                        "start": 306,
                                                        "end": 309,
                                                        "start_line": 11,
                                                        "start_col": 42
                                                      }
                                                    },
                                                    "op": "Concat",
                                                    "right": {
                                                      "kind": {
                                                        "String": "b"
                                                      },
                                                      "span": {
                                                        "start": 312,
                                                        "end": 315,
                                                        "start_line": 11,
                                                        "start_col": 48
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 306,
                                                  "end": 315,
                                                  "start_line": 11,
                                                  "start_col": 42
                                                }
                                              },
                                              "is_from": false
                                            }
                                          },
                                          "span": {
                                            "start": 292,
                                            "end": 315,
                                            "start_line": 11,
                                            "start_col": 28
                                          }
                                        },
                                        "is_from": false
                                      }
                                    },
                                    "span": {
                                      "start": 278,
                                      "end": 315,
                                      "start_line": 11,
                                      "start_col": 14
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 278,
                                    "end": 315,
                                    "start_line": 11,
                                    "start_col": 14
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 277,
                              "end": 316,
                              "start_line": 11,
                              "start_col": 13
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 277,
                            "end": 316,
                            "start_line": 11,
                            "start_col": 13
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 268,
                    "end": 317,
                    "start_line": 11,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 268,
                "end": 323,
                "start_line": 11,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "var_dump"
                        },
                        "span": {
                          "start": 323,
                          "end": 331,
                          "start_line": 12,
                          "start_col": 4
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Array": [
                                {
                                  "key": {
                                    "kind": {
                                      "Yield": {
                                        "key": {
                                          "kind": {
                                            "String": "k1"
                                          },
                                          "span": {
                                            "start": 339,
                                            "end": 343,
                                            "start_line": 12,
                                            "start_col": 20
                                          }
                                        },
                                        "value": {
                                          "kind": {
                                            "Parenthesized": {
                                              "kind": {
                                                "Yield": {
                                                  "key": null,
                                                  "value": {
                                                    "kind": {
                                                      "String": "k2"
                                                    },
                                                    "span": {
                                                      "start": 354,
                                                      "end": 358,
                                                      "start_line": 12,
                                                      "start_col": 35
                                                    }
                                                  },
                                                  "is_from": false
                                                }
                                              },
                                              "span": {
                                                "start": 348,
                                                "end": 358,
                                                "start_line": 12,
                                                "start_col": 29
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 347,
                                            "end": 360,
                                            "start_line": 12,
                                            "start_col": 28
                                          }
                                        },
                                        "is_from": false
                                      }
                                    },
                                    "span": {
                                      "start": 333,
                                      "end": 360,
                                      "start_line": 12,
                                      "start_col": 14
                                    }
                                  },
                                  "value": {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "String": "a"
                                          },
                                          "span": {
                                            "start": 363,
                                            "end": 366,
                                            "start_line": 12,
                                            "start_col": 44
                                          }
                                        },
                                        "op": "Concat",
                                        "right": {
                                          "kind": {
                                            "String": "b"
                                          },
                                          "span": {
                                            "start": 369,
                                            "end": 372,
                                            "start_line": 12,
                                            "start_col": 50
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 363,
                                      "end": 372,
                                      "start_line": 12,
                                      "start_col": 44
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 333,
                                    "end": 372,
                                    "start_line": 12,
                                    "start_col": 14
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 332,
                              "end": 373,
                              "start_line": 12,
                              "start_col": 13
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 332,
                            "end": 373,
                            "start_line": 12,
                            "start_col": 13
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 323,
                    "end": 374,
                    "start_line": 12,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 323,
                "end": 376,
                "start_line": 12,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 377,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 377,
    "start_line": 1,
    "start_col": 0
  }
}

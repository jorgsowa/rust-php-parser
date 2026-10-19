===config===
min_php=8.5
===source===
<?php

namespace {
    function f() {
        echo __FUNCTION__, "\n";
    }
    f();
}

namespace Ns {
    function f() {
        echo __FUNCTION__, "\n";
    }
    f();
}

namespace {
    use function Ns\f;
    f();
}

namespace Ns {
    use function f;
    f();
}

namespace {
    f();
}

namespace Ns {
    f();
}

namespace {
    use function f;
    f();
}

namespace Ns {
    use function Ns\f;
    f();
}

?>
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
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 32,
                        "end": 33
                      }
                    },
                    "params": [],
                    "body": [
                      {
                        "kind": {
                          "Echo": [
                            {
                              "kind": {
                                "MagicConst": "Function"
                              },
                              "span": {
                                "start": 51,
                                "end": 63
                              }
                            },
                            {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 65,
                                "end": 69
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 46,
                          "end": 70
                        }
                      }
                    ],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 23,
                  "end": 76
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
                                "f"
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
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 81,
                      "end": 84
                    }
                  }
                },
                "span": {
                  "start": 81,
                  "end": 85
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 7,
        "end": 87
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Ns"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 99,
              "end": 101
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 117,
                        "end": 118
                      }
                    },
                    "params": [],
                    "body": [
                      {
                        "kind": {
                          "Echo": [
                            {
                              "kind": {
                                "MagicConst": "Function"
                              },
                              "span": {
                                "start": 136,
                                "end": 148
                              }
                            },
                            {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 150,
                                "end": 154
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 131,
                          "end": 155
                        }
                      }
                    ],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 108,
                  "end": 161
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
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 166,
                                "end": 167
                              }
                            }
                          },
                          "span": {
                            "start": 166,
                            "end": 167
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 166,
                      "end": 169
                    }
                  }
                },
                "span": {
                  "start": 166,
                  "end": 170
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 89,
        "end": 172
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
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "f"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 203,
                            "end": 207
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 203,
                          "end": 207
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 190,
                  "end": 208
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
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 213,
                                "end": 214
                              }
                            }
                          },
                          "span": {
                            "start": 213,
                            "end": 214
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 213,
                      "end": 216
                    }
                  }
                },
                "span": {
                  "start": 213,
                  "end": 217
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 174,
        "end": 219
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Ns"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 231,
              "end": 233
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 253,
                            "end": 254
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 253,
                          "end": 254
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 240,
                  "end": 255
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
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 260,
                                "end": 261
                              }
                            }
                          },
                          "span": {
                            "start": 260,
                            "end": 261
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 260,
                      "end": 263
                    }
                  }
                },
                "span": {
                  "start": 260,
                  "end": 264
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 221,
        "end": 266
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
                  "Expression": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 284,
                                "end": 285
                              }
                            }
                          },
                          "span": {
                            "start": 284,
                            "end": 285
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 284,
                      "end": 287
                    }
                  }
                },
                "span": {
                  "start": 284,
                  "end": 288
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 268,
        "end": 290
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Ns"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 302,
              "end": 304
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
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 311,
                                "end": 312
                              }
                            }
                          },
                          "span": {
                            "start": 311,
                            "end": 312
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 311,
                      "end": 314
                    }
                  }
                },
                "span": {
                  "start": 311,
                  "end": 315
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 292,
        "end": 317
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
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 348,
                            "end": 349
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 348,
                          "end": 349
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 335,
                  "end": 350
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
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 355,
                                "end": 356
                              }
                            }
                          },
                          "span": {
                            "start": 355,
                            "end": 356
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 355,
                      "end": 358
                    }
                  }
                },
                "span": {
                  "start": 355,
                  "end": 359
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 319,
        "end": 361
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Ns"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 373,
              "end": 375
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "f"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 395,
                            "end": 399
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 395,
                          "end": 399
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 382,
                  "end": 400
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
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 405,
                                "end": 406
                              }
                            }
                          },
                          "span": {
                            "start": 405,
                            "end": 406
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 405,
                      "end": 408
                    }
                  }
                },
                "span": {
                  "start": 405,
                  "end": 409
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 363,
        "end": 411
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 411
  }
}

===config===
min_php=8.5
===source===
<?php

namespace {
    class C {}
    var_dump(new C);
}

namespace Ns {
    class C {}
    var_dump(new C);
}

namespace {
    use Ns\C;
    var_dump(new C);
}

namespace Ns {
    use C;
    var_dump(new C);
}

namespace {
    var_dump(new C);
}

namespace Ns {
    var_dump(new C);
}

namespace {
    use C;
    var_dump(new C);
}

namespace Ns {
    use Ns\C;
    var_dump(new C);
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
                  "Class": {
                    "name": {
                      "name": "C",
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 23,
                  "end": 33
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
                                "var_dump"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 38,
                                "end": 46
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 46
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "C"
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
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 47,
                                  "end": 52
                                }
                              }
                            },
                            "span": {
                              "start": 47,
                              "end": 52
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 53
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 54
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 7,
        "end": 56
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
              "start": 68,
              "end": 70
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "C",
                      "span": {
                        "start": 83,
                        "end": 84
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 77,
                  "end": 87
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
                                "var_dump"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 92,
                                "end": 100
                              }
                            }
                          },
                          "span": {
                            "start": 92,
                            "end": 100
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "C"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 105,
                                            "end": 106
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 105,
                                        "end": 106
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 101,
                                  "end": 106
                                }
                              }
                            },
                            "span": {
                              "start": 101,
                              "end": 106
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 92,
                      "end": 107
                    }
                  }
                },
                "span": {
                  "start": 92,
                  "end": 108
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 58,
        "end": 110
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
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "Ns",
                            "C"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 132,
                            "end": 136
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 132,
                          "end": 136
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 128,
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
                                "var_dump"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 142,
                                "end": 150
                              }
                            }
                          },
                          "span": {
                            "start": 142,
                            "end": 150
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "C"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 155,
                                            "end": 156
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 155,
                                        "end": 156
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 151,
                                  "end": 156
                                }
                              }
                            },
                            "span": {
                              "start": 151,
                              "end": 156
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 142,
                      "end": 157
                    }
                  }
                },
                "span": {
                  "start": 142,
                  "end": 158
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 112,
        "end": 160
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
              "start": 172,
              "end": 174
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
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 185,
                            "end": 186
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 185,
                          "end": 186
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 181,
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
                                "var_dump"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 192,
                                "end": 200
                              }
                            }
                          },
                          "span": {
                            "start": 192,
                            "end": 200
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "C"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 205,
                                            "end": 206
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 205,
                                        "end": 206
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 201,
                                  "end": 206
                                }
                              }
                            },
                            "span": {
                              "start": 201,
                              "end": 206
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 192,
                      "end": 207
                    }
                  }
                },
                "span": {
                  "start": 192,
                  "end": 208
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 162,
        "end": 210
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
                                "var_dump"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 228,
                                "end": 236
                              }
                            }
                          },
                          "span": {
                            "start": 228,
                            "end": 236
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "C"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 241,
                                            "end": 242
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 241,
                                        "end": 242
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 237,
                                  "end": 242
                                }
                              }
                            },
                            "span": {
                              "start": 237,
                              "end": 242
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 228,
                      "end": 243
                    }
                  }
                },
                "span": {
                  "start": 228,
                  "end": 244
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 212,
        "end": 246
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
              "start": 258,
              "end": 260
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
                                "var_dump"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 267,
                                "end": 275
                              }
                            }
                          },
                          "span": {
                            "start": 267,
                            "end": 275
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "C"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 280,
                                            "end": 281
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 280,
                                        "end": 281
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 276,
                                  "end": 281
                                }
                              }
                            },
                            "span": {
                              "start": 276,
                              "end": 281
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 267,
                      "end": 282
                    }
                  }
                },
                "span": {
                  "start": 267,
                  "end": 283
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 248,
        "end": 285
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
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 307,
                            "end": 308
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 307,
                          "end": 308
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 303,
                  "end": 309
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
                                "var_dump"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 314,
                                "end": 322
                              }
                            }
                          },
                          "span": {
                            "start": 314,
                            "end": 322
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "C"
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
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 323,
                                  "end": 328
                                }
                              }
                            },
                            "span": {
                              "start": 323,
                              "end": 328
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 314,
                      "end": 329
                    }
                  }
                },
                "span": {
                  "start": 314,
                  "end": 330
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 287,
        "end": 332
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
              "start": 344,
              "end": 346
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
                            "Ns",
                            "C"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 357,
                            "end": 361
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 357,
                          "end": 361
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 353,
                  "end": 362
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
                                "var_dump"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 367,
                                "end": 375
                              }
                            }
                          },
                          "span": {
                            "start": 367,
                            "end": 375
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "C"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 380,
                                            "end": 381
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 380,
                                        "end": 381
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 376,
                                  "end": 381
                                }
                              }
                            },
                            "span": {
                              "start": 376,
                              "end": 381
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 367,
                      "end": 382
                    }
                  }
                },
                "span": {
                  "start": 367,
                  "end": 383
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 334,
        "end": 385
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 385
  }
}

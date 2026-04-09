===source===
<?php

"abc"[2];
"abc"[2][0][0];

[1, 2, 3][2];
[1, 2, 3][2][0][0];

array(1, 2, 3)[2];
array(1, 2, 3)[2][0][0];

FOO[0];
Foo::BAR[1];
$foo::BAR[2][1][0];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "String": "abc"
                },
                "span": {
                  "start": 7,
                  "end": 12,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 13,
                  "end": 14,
                  "start_line": 3,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 15,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 17,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "String": "abc"
                            },
                            "span": {
                              "start": 17,
                              "end": 22,
                              "start_line": 4,
                              "start_col": 0
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 23,
                              "end": 24,
                              "start_line": 4,
                              "start_col": 6
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 25,
                        "start_line": 4,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 26,
                        "end": 27,
                        "start_line": 4,
                        "start_col": 9
                      }
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 28,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 29,
                  "end": 30,
                  "start_line": 4,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 31,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 17,
        "end": 34,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 35,
                          "end": 36,
                          "start_line": 6,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 35,
                        "end": 36,
                        "start_line": 6,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 38,
                          "end": 39,
                          "start_line": 6,
                          "start_col": 4
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 38,
                        "end": 39,
                        "start_line": 6,
                        "start_col": 4
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 41,
                          "end": 42,
                          "start_line": 6,
                          "start_col": 7
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 41,
                        "end": 42,
                        "start_line": 6,
                        "start_col": 7
                      }
                    }
                  ]
                },
                "span": {
                  "start": 34,
                  "end": 43,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 44,
                  "end": 45,
                  "start_line": 6,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 46,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 34,
        "end": 48,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Array": [
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 49,
                                      "end": 50,
                                      "start_line": 7,
                                      "start_col": 1
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 49,
                                    "end": 50,
                                    "start_line": 7,
                                    "start_col": 1
                                  }
                                },
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 52,
                                      "end": 53,
                                      "start_line": 7,
                                      "start_col": 4
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 52,
                                    "end": 53,
                                    "start_line": 7,
                                    "start_col": 4
                                  }
                                },
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Int": 3
                                    },
                                    "span": {
                                      "start": 55,
                                      "end": 56,
                                      "start_line": 7,
                                      "start_col": 7
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 55,
                                    "end": 56,
                                    "start_line": 7,
                                    "start_col": 7
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 48,
                              "end": 57,
                              "start_line": 7,
                              "start_col": 0
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 58,
                              "end": 59,
                              "start_line": 7,
                              "start_col": 10
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 48,
                        "end": 60,
                        "start_line": 7,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 61,
                        "end": 62,
                        "start_line": 7,
                        "start_col": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 63,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 64,
                  "end": 65,
                  "start_line": 7,
                  "start_col": 16
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 66,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 48,
        "end": 69,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 75,
                          "end": 76,
                          "start_line": 9,
                          "start_col": 6
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 75,
                        "end": 76,
                        "start_line": 9,
                        "start_col": 6
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 78,
                          "end": 79,
                          "start_line": 9,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 78,
                        "end": 79,
                        "start_line": 9,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 81,
                          "end": 82,
                          "start_line": 9,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 81,
                        "end": 82,
                        "start_line": 9,
                        "start_col": 12
                      }
                    }
                  ]
                },
                "span": {
                  "start": 69,
                  "end": 83,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 84,
                  "end": 85,
                  "start_line": 9,
                  "start_col": 15
                }
              }
            }
          },
          "span": {
            "start": 69,
            "end": 86,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 69,
        "end": 88,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Array": [
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 94,
                                      "end": 95,
                                      "start_line": 10,
                                      "start_col": 6
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 94,
                                    "end": 95,
                                    "start_line": 10,
                                    "start_col": 6
                                  }
                                },
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 97,
                                      "end": 98,
                                      "start_line": 10,
                                      "start_col": 9
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 97,
                                    "end": 98,
                                    "start_line": 10,
                                    "start_col": 9
                                  }
                                },
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Int": 3
                                    },
                                    "span": {
                                      "start": 100,
                                      "end": 101,
                                      "start_line": 10,
                                      "start_col": 12
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 100,
                                    "end": 101,
                                    "start_line": 10,
                                    "start_col": 12
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 88,
                              "end": 102,
                              "start_line": 10,
                              "start_col": 0
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 103,
                              "end": 104,
                              "start_line": 10,
                              "start_col": 15
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 88,
                        "end": 105,
                        "start_line": 10,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 106,
                        "end": 107,
                        "start_line": 10,
                        "start_col": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 88,
                  "end": 108,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 109,
                  "end": 110,
                  "start_line": 10,
                  "start_col": 21
                }
              }
            }
          },
          "span": {
            "start": 88,
            "end": 111,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 88,
        "end": 114,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Identifier": "FOO"
                },
                "span": {
                  "start": 114,
                  "end": 117,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 118,
                  "end": 119,
                  "start_line": 12,
                  "start_col": 4
                }
              }
            }
          },
          "span": {
            "start": 114,
            "end": 120,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 114,
        "end": 122,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 122,
                        "end": 125,
                        "start_line": 13,
                        "start_col": 0
                      }
                    },
                    "member": "BAR"
                  }
                },
                "span": {
                  "start": 122,
                  "end": 130,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 131,
                  "end": 132,
                  "start_line": 13,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 133,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 122,
        "end": 135,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Variable": "foo"
                                  },
                                  "span": {
                                    "start": 135,
                                    "end": 139,
                                    "start_line": 14,
                                    "start_col": 0
                                  }
                                },
                                "member": "BAR"
                              }
                            },
                            "span": {
                              "start": 135,
                              "end": 144,
                              "start_line": 14,
                              "start_col": 0
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 145,
                              "end": 146,
                              "start_line": 14,
                              "start_col": 10
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 135,
                        "end": 147,
                        "start_line": 14,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 148,
                        "end": 149,
                        "start_line": 14,
                        "start_col": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 135,
                  "end": 150,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 151,
                  "end": 152,
                  "start_line": 14,
                  "start_col": 16
                }
              }
            }
          },
          "span": {
            "start": 135,
            "end": 153,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 135,
        "end": 154,
        "start_line": 14,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 154,
    "start_line": 1,
    "start_col": 0
  }
}

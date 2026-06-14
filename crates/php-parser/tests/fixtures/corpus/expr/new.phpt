===source===
<?php

new A;
new A($b);

// class name variations
new $a();
new $a['b']();
new A::$b();
// DNCR object access
new $a->b();
new $a->b->c();
new $a->b['c']();

// test regression introduces by new dereferencing syntax
(new A);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 12
          }
        }
      },
      "span": {
        "start": 7,
        "end": 13
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 18,
                  "end": 19
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 20,
                      "end": 22
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 22
                  }
                }
              ]
            }
          },
          "span": {
            "start": 14,
            "end": 23
          }
        }
      },
      "span": {
        "start": 14,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 55,
                  "end": 57
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 51,
            "end": 59
          }
        }
      },
      "span": {
        "start": 51,
        "end": 60
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 65,
                        "end": 67
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 68,
                        "end": 71
                      }
                    }
                  }
                },
                "span": {
                  "start": 65,
                  "end": 72
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 61,
            "end": 74
          }
        }
      },
      "span": {
        "start": 61,
        "end": 75
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 80,
                        "end": 81
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 83,
                        "end": 85
                      }
                    }
                  }
                },
                "span": {
                  "start": 80,
                  "end": 85
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 76,
            "end": 87
          }
        }
      },
      "span": {
        "start": 76,
        "end": 88
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 115,
                        "end": 117
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 119,
                        "end": 120
                      }
                    }
                  }
                },
                "span": {
                  "start": 115,
                  "end": 120
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 111,
            "end": 122
          }
        }
      },
      "span": {
        "start": 111,
        "end": 123
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 128,
                              "end": 130
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 132,
                              "end": 133
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 128,
                        "end": 133
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 135,
                        "end": 136
                      }
                    }
                  }
                },
                "span": {
                  "start": 128,
                  "end": 136
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 124,
            "end": 138
          }
        }
      },
      "span": {
        "start": 124,
        "end": 139
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 144,
                              "end": 146
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 148,
                              "end": 149
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 144,
                        "end": 149
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "c"
                      },
                      "span": {
                        "start": 150,
                        "end": 153
                      }
                    }
                  }
                },
                "span": {
                  "start": 144,
                  "end": 154
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 140,
            "end": 156
          }
        }
      },
      "span": {
        "start": 140,
        "end": 157
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Parenthesized": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Identifier": "A"
                    },
                    "span": {
                      "start": 222,
                      "end": 223
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 218,
                "end": 223
              }
            }
          },
          "span": {
            "start": 217,
            "end": 224
          }
        }
      },
      "span": {
        "start": 217,
        "end": 225
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 225
  }
}

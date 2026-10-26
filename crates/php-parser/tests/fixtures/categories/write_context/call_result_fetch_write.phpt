===source===
<?php
namespace A {
    strlen($a)[0] = 1;
}
namespace {
    strlen(...$a)[0] = 1;
    count($a, $b)[0] = 1;
    defined($a)[0] = 1;
    sprintf('%05d', $a)[0] = 1;
    func_get_args()[0] = 1;
    f($a)[0] = 1;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
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
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
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
                                            "start": 24,
                                            "end": 30
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 24,
                                        "end": 30
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 31,
                                              "end": 33
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 31,
                                          "end": 33
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 24,
                                  "end": 34
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 35,
                                  "end": 36
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 24,
                            "end": 37
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 40,
                            "end": 41
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 41
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 42
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44
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
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
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
                                            "start": 61,
                                            "end": 67
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 61,
                                        "end": 67
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Spread": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 71,
                                              "end": 73
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 68,
                                          "end": 73
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 61,
                                  "end": 74
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 75,
                                  "end": 76
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 61,
                            "end": 77
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 80,
                            "end": 81
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 61,
                      "end": 81
                    }
                  }
                },
                "span": {
                  "start": 61,
                  "end": 82
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "count"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 87,
                                            "end": 92
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 87,
                                        "end": 92
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 93,
                                              "end": 95
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 93,
                                          "end": 95
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "b"
                                            },
                                            "span": {
                                              "start": 97,
                                              "end": 99
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 97,
                                          "end": 99
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 87,
                                  "end": 100
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 101,
                                  "end": 102
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 87,
                            "end": 103
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 106,
                            "end": 107
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 87,
                      "end": 107
                    }
                  }
                },
                "span": {
                  "start": 87,
                  "end": 108
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "defined"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 113,
                                            "end": 120
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 113,
                                        "end": 120
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 121,
                                              "end": 123
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 121,
                                          "end": 123
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 113,
                                  "end": 124
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 125,
                                  "end": 126
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 113,
                            "end": 127
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 130,
                            "end": 131
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 113,
                      "end": 131
                    }
                  }
                },
                "span": {
                  "start": 113,
                  "end": 132
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
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
                                            "start": 137,
                                            "end": 144
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 137,
                                        "end": 144
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "%05d"
                                            },
                                            "span": {
                                              "start": 145,
                                              "end": 151
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 145,
                                          "end": 151
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 153,
                                              "end": 155
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 153,
                                          "end": 155
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 137,
                                  "end": 156
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 157,
                                  "end": 158
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 137,
                            "end": 159
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 162,
                            "end": 163
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 137,
                      "end": 163
                    }
                  }
                },
                "span": {
                  "start": 137,
                  "end": 164
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "func_get_args"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 169,
                                            "end": 182
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 169,
                                        "end": 182
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 169,
                                  "end": 184
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 185,
                                  "end": 186
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 169,
                            "end": 187
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 190,
                            "end": 191
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 169,
                      "end": 191
                    }
                  }
                },
                "span": {
                  "start": 169,
                  "end": 192
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
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
                                            "start": 197,
                                            "end": 198
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 197,
                                        "end": 198
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 199,
                                              "end": 201
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 199,
                                          "end": 201
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 197,
                                  "end": 202
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 203,
                                  "end": 204
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 197,
                            "end": 205
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 208,
                            "end": 209
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 197,
                      "end": 209
                    }
                  }
                },
                "span": {
                  "start": 197,
                  "end": 210
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 45,
        "end": 212
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 212
  }
}

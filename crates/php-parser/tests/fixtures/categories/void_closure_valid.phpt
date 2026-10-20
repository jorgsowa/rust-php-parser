===source===
<?php
$a = function(): void { return; };
$b = function(): void { $g = function() { return 1; }; };
$c = function(): void { $g = fn() => 1; };
$d = fn(): never => throw new E;
$e = fn(): int => 1;
$f = function(): never { throw new E; };
$g = function(): ?int { return 1; };
===errors 8.1===
A never-returning function must not return
===php_error 8.1===
PHP Fatal error:  A never-returning function must not return in Standard input code on line 5
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "void"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 27
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": null
                        },
                        "span": {
                          "start": 30,
                          "end": 37
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 41,
                  "end": 43
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "void"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 58,
                            "end": 62
                          }
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 62
                      }
                    },
                    "body": [
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
                                    "start": 65,
                                    "end": 67
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Closure": {
                                      "is_static": false,
                                      "by_ref": false,
                                      "params": [],
                                      "use_vars": [],
                                      "return_type": null,
                                      "body": [
                                        {
                                          "kind": {
                                            "Return": {
                                              "kind": {
                                                "Int": 1
                                              },
                                              "span": {
                                                "start": 90,
                                                "end": 91
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 83,
                                            "end": 92
                                          }
                                        }
                                      ],
                                      "attributes": []
                                    }
                                  },
                                  "span": {
                                    "start": 70,
                                    "end": 94
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 65,
                              "end": 94
                            }
                          }
                        },
                        "span": {
                          "start": 65,
                          "end": 95
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 46,
                  "end": 97
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 97
          }
        }
      },
      "span": {
        "start": 41,
        "end": 98
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 99,
                  "end": 101
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "void"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 116,
                            "end": 120
                          }
                        }
                      },
                      "span": {
                        "start": 116,
                        "end": 120
                      }
                    },
                    "body": [
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
                                    "start": 123,
                                    "end": 125
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "ArrowFunction": {
                                      "is_static": false,
                                      "by_ref": false,
                                      "params": [],
                                      "return_type": null,
                                      "body": {
                                        "kind": {
                                          "Int": 1
                                        },
                                        "span": {
                                          "start": 136,
                                          "end": 137
                                        }
                                      },
                                      "attributes": []
                                    }
                                  },
                                  "span": {
                                    "start": 128,
                                    "end": 137
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 123,
                              "end": 137
                            }
                          }
                        },
                        "span": {
                          "start": 123,
                          "end": 138
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 104,
                  "end": 140
                }
              }
            }
          },
          "span": {
            "start": 99,
            "end": 140
          }
        }
      },
      "span": {
        "start": 99,
        "end": 141
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 142,
                  "end": 144
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
                        "Named": {
                          "parts": [
                            "never"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 153,
                            "end": 158
                          }
                        }
                      },
                      "span": {
                        "start": 153,
                        "end": 158
                      }
                    },
                    "body": {
                      "kind": {
                        "Throw": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "E"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 172,
                                      "end": 173
                                    }
                                  }
                                },
                                "span": {
                                  "start": 172,
                                  "end": 173
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 168,
                            "end": 173
                          }
                        }
                      },
                      "span": {
                        "start": 162,
                        "end": 173
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 147,
                  "end": 173
                }
              }
            }
          },
          "span": {
            "start": 142,
            "end": 173
          }
        }
      },
      "span": {
        "start": 142,
        "end": 174
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 175,
                  "end": 177
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
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 186,
                            "end": 189
                          }
                        }
                      },
                      "span": {
                        "start": 186,
                        "end": 189
                      }
                    },
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 193,
                        "end": 194
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 180,
                  "end": 194
                }
              }
            }
          },
          "span": {
            "start": 175,
            "end": 194
          }
        }
      },
      "span": {
        "start": 175,
        "end": 195
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
                  "start": 196,
                  "end": 198
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "never"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 213,
                            "end": 218
                          }
                        }
                      },
                      "span": {
                        "start": 213,
                        "end": 218
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Throw": {
                            "kind": {
                              "New": {
                                "class": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "E"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 231,
                                        "end": 232
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 231,
                                    "end": 232
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 227,
                              "end": 232
                            }
                          }
                        },
                        "span": {
                          "start": 221,
                          "end": 233
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 201,
                  "end": 235
                }
              }
            }
          },
          "span": {
            "start": 196,
            "end": 235
          }
        }
      },
      "span": {
        "start": 196,
        "end": 236
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
                  "start": 237,
                  "end": 239
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Nullable": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 255,
                                "end": 258
                              }
                            }
                          },
                          "span": {
                            "start": 255,
                            "end": 258
                          }
                        }
                      },
                      "span": {
                        "start": 254,
                        "end": 258
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 268,
                              "end": 269
                            }
                          }
                        },
                        "span": {
                          "start": 261,
                          "end": 270
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 242,
                  "end": 272
                }
              }
            }
          },
          "span": {
            "start": 237,
            "end": 272
          }
        }
      },
      "span": {
        "start": 237,
        "end": 273
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 273
  }
}

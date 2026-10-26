===source===
<?php
function test($var) {}
test($arr[]);
TEST($o->p[]);
function g() {
    \test($arr[][0]);
}
function refs($a, &$b, ...$rest) {}
refs($a[], $b[], $c[]);
namespace\test($arr[]);
===errors===
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
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "params": [
            {
              "name": {
                "name": "var",
                "span": {
                  "start": 20,
                  "end": 24
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 20,
                "end": 24
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
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
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "test"
                    ],
                    "kind": "Unqualified",
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
                              "Variable": "arr"
                            },
                            "span": {
                              "start": 34,
                              "end": 38
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 40
                      }
                    }
                  },
                  "span": {
                    "start": 34,
                    "end": 40
                  }
                }
              ]
            }
          },
          "span": {
            "start": 29,
            "end": 41
          }
        }
      },
      "span": {
        "start": 29,
        "end": 42
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
                      "TEST"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 43,
                      "end": 47
                    }
                  }
                },
                "span": {
                  "start": 43,
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
                              "PropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Variable": "o"
                                  },
                                  "span": {
                                    "start": 48,
                                    "end": 50
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "p"
                                  },
                                  "span": {
                                    "start": 52,
                                    "end": 53
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 48,
                              "end": 53
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 48,
                        "end": 55
                      }
                    }
                  },
                  "span": {
                    "start": 48,
                    "end": 55
                  }
                }
              ]
            }
          },
          "span": {
            "start": 43,
            "end": 56
          }
        }
      },
      "span": {
        "start": 43,
        "end": 57
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 67,
              "end": 68
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "test"
                            ],
                            "kind": "FullyQualified",
                            "span": {
                              "start": 77,
                              "end": 82
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 82
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
                                      "ArrayAccess": {
                                        "array": {
                                          "kind": {
                                            "Variable": "arr"
                                          },
                                          "span": {
                                            "start": 83,
                                            "end": 87
                                          }
                                        },
                                        "index": null
                                      }
                                    },
                                    "span": {
                                      "start": 83,
                                      "end": 89
                                    }
                                  },
                                  "index": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 90,
                                      "end": 91
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 83,
                                "end": 92
                              }
                            }
                          },
                          "span": {
                            "start": 83,
                            "end": 92
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 77,
                    "end": 93
                  }
                }
              },
              "span": {
                "start": 77,
                "end": 94
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 58,
        "end": 96
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "refs",
            "span": {
              "start": 106,
              "end": 110
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 111,
                  "end": 113
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 111,
                "end": 113
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 116,
                  "end": 118
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 115,
                "end": 118
              }
            },
            {
              "name": {
                "name": "rest",
                "span": {
                  "start": 123,
                  "end": 128
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 120,
                "end": 128
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 97,
        "end": 132
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
                      "refs"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 133,
                      "end": 137
                    }
                  }
                },
                "span": {
                  "start": 133,
                  "end": 137
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
                              "start": 138,
                              "end": 140
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 138,
                        "end": 142
                      }
                    }
                  },
                  "span": {
                    "start": 138,
                    "end": 142
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
                              "start": 144,
                              "end": 146
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 144,
                        "end": 148
                      }
                    }
                  },
                  "span": {
                    "start": 144,
                    "end": 148
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
                              "Variable": "c"
                            },
                            "span": {
                              "start": 150,
                              "end": 152
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 150,
                        "end": 154
                      }
                    }
                  },
                  "span": {
                    "start": 150,
                    "end": 154
                  }
                }
              ]
            }
          },
          "span": {
            "start": 133,
            "end": 155
          }
        }
      },
      "span": {
        "start": 133,
        "end": 156
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
                      "test"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 157,
                      "end": 171
                    }
                  }
                },
                "span": {
                  "start": 157,
                  "end": 171
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
                              "Variable": "arr"
                            },
                            "span": {
                              "start": 172,
                              "end": 176
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 172,
                        "end": 178
                      }
                    }
                  },
                  "span": {
                    "start": 172,
                    "end": 178
                  }
                }
              ]
            }
          },
          "span": {
            "start": 157,
            "end": 179
          }
        }
      },
      "span": {
        "start": 157,
        "end": 180
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 180
  }
}

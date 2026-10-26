===source===
<?php
function f(&$a, ...$rest) {}
function refs($a, &...$rest) {}
f(strlen('x')[0]);
f(count($a)[0][1]);
F(strlen('x')->p);
refs($b, $c, gettype($a)[0]);
f($b, strlen('x')[0]);
f(strlen('x'));
namespace\f(is_int($a)[0]);
===errors===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===php_error===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 18,
                  "end": 20
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 20
              }
            },
            {
              "name": {
                "name": "rest",
                "span": {
                  "start": 25,
                  "end": 30
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 22,
                "end": 30
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
        "end": 34
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "refs",
            "span": {
              "start": 44,
              "end": 48
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 49,
                  "end": 51
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 49,
                "end": 51
              }
            },
            {
              "name": {
                "name": "rest",
                "span": {
                  "start": 57,
                  "end": 62
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 53,
                "end": 62
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
        "start": 35,
        "end": 66
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
                      "start": 67,
                      "end": 68
                    }
                  }
                },
                "span": {
                  "start": 67,
                  "end": 68
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
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "strlen"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 69,
                                        "end": 75
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 69,
                                    "end": 75
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "String": "x"
                                        },
                                        "span": {
                                          "start": 76,
                                          "end": 79
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 76,
                                      "end": 79
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 69,
                              "end": 80
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 81,
                              "end": 82
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 69,
                        "end": 83
                      }
                    }
                  },
                  "span": {
                    "start": 69,
                    "end": 83
                  }
                }
              ]
            }
          },
          "span": {
            "start": 67,
            "end": 84
          }
        }
      },
      "span": {
        "start": 67,
        "end": 85
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
                      "start": 86,
                      "end": 87
                    }
                  }
                },
                "span": {
                  "start": 86,
                  "end": 87
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
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "count"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 88,
                                              "end": 93
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 88,
                                          "end": 93
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
                                                "start": 94,
                                                "end": 96
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 94,
                                            "end": 96
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 88,
                                    "end": 97
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 98,
                                    "end": 99
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 88,
                              "end": 100
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 101,
                              "end": 102
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 88,
                        "end": 103
                      }
                    }
                  },
                  "span": {
                    "start": 88,
                    "end": 103
                  }
                }
              ]
            }
          },
          "span": {
            "start": 86,
            "end": 104
          }
        }
      },
      "span": {
        "start": 86,
        "end": 105
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
                      "F"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 106,
                      "end": 107
                    }
                  }
                },
                "span": {
                  "start": 106,
                  "end": 107
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
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
                                        "start": 108,
                                        "end": 114
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 108,
                                    "end": 114
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "String": "x"
                                        },
                                        "span": {
                                          "start": 115,
                                          "end": 118
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 115,
                                      "end": 118
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 108,
                              "end": 119
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "p"
                            },
                            "span": {
                              "start": 121,
                              "end": 122
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 108,
                        "end": 122
                      }
                    }
                  },
                  "span": {
                    "start": 108,
                    "end": 122
                  }
                }
              ]
            }
          },
          "span": {
            "start": 106,
            "end": 123
          }
        }
      },
      "span": {
        "start": 106,
        "end": 124
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
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 130,
                        "end": 132
                      }
                    }
                  },
                  "span": {
                    "start": 130,
                    "end": 132
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 134,
                        "end": 136
                      }
                    }
                  },
                  "span": {
                    "start": 134,
                    "end": 136
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
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "gettype"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 138,
                                        "end": 145
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 138,
                                    "end": 145
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
                                          "start": 146,
                                          "end": 148
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 146,
                                      "end": 148
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 138,
                              "end": 149
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 150,
                              "end": 151
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 138,
                        "end": 152
                      }
                    }
                  },
                  "span": {
                    "start": 138,
                    "end": 152
                  }
                }
              ]
            }
          },
          "span": {
            "start": 125,
            "end": 153
          }
        }
      },
      "span": {
        "start": 125,
        "end": 154
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
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 157,
                        "end": 159
                      }
                    }
                  },
                  "span": {
                    "start": 157,
                    "end": 159
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
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "strlen"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 161,
                                        "end": 167
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 161,
                                    "end": 167
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "String": "x"
                                        },
                                        "span": {
                                          "start": 168,
                                          "end": 171
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 168,
                                      "end": 171
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 161,
                              "end": 172
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 173,
                              "end": 174
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 161,
                        "end": 175
                      }
                    }
                  },
                  "span": {
                    "start": 161,
                    "end": 175
                  }
                }
              ]
            }
          },
          "span": {
            "start": 155,
            "end": 176
          }
        }
      },
      "span": {
        "start": 155,
        "end": 177
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
                      "start": 178,
                      "end": 179
                    }
                  }
                },
                "span": {
                  "start": 178,
                  "end": 179
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
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
                                  "start": 180,
                                  "end": 186
                                }
                              }
                            },
                            "span": {
                              "start": 180,
                              "end": 186
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "String": "x"
                                  },
                                  "span": {
                                    "start": 187,
                                    "end": 190
                                  }
                                }
                              },
                              "span": {
                                "start": 187,
                                "end": 190
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 180,
                        "end": 191
                      }
                    }
                  },
                  "span": {
                    "start": 180,
                    "end": 191
                  }
                }
              ]
            }
          },
          "span": {
            "start": 178,
            "end": 192
          }
        }
      },
      "span": {
        "start": 178,
        "end": 193
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
                    "kind": "Relative",
                    "span": {
                      "start": 194,
                      "end": 205
                    }
                  }
                },
                "span": {
                  "start": 194,
                  "end": 205
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
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "is_int"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 206,
                                        "end": 212
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 206,
                                    "end": 212
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
                                          "start": 213,
                                          "end": 215
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 213,
                                      "end": 215
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 206,
                              "end": 216
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 217,
                              "end": 218
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 206,
                        "end": 219
                      }
                    }
                  },
                  "span": {
                    "start": 206,
                    "end": 219
                  }
                }
              ]
            }
          },
          "span": {
            "start": 194,
            "end": 220
          }
        }
      },
      "span": {
        "start": 194,
        "end": 221
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 221
  }
}

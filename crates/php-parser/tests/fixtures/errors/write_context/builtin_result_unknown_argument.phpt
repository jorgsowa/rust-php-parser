===source===
<?php
namespace A;
g(\strlen('x')[0]);
$o->m(\strlen('x')[0]);
B::m(\count($a)[0]);
new C(\strlen('x')->p);
$f(\gettype($a)[0]);
function f(&$a) {
    f(\strlen('x')[0]);
}
f(strlen('x')[0]);
f(\strlen('x'));
===errors <=8.0===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===php_error <=8.0===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 3
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
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
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
                      "g"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 20
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 20
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
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 21,
                                        "end": 28
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 21,
                                    "end": 28
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
                                          "start": 29,
                                          "end": 32
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 29,
                                      "end": 32
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 21,
                              "end": 33
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 34,
                              "end": 35
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 36
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 36
                  }
                }
              ]
            }
          },
          "span": {
            "start": 19,
            "end": 37
          }
        }
      },
      "span": {
        "start": 19,
        "end": 38
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 39,
                  "end": 41
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 43,
                  "end": 44
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
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 45,
                                        "end": 52
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 45,
                                    "end": 52
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
                                          "start": 53,
                                          "end": 56
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 53,
                                      "end": 56
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 45,
                              "end": 57
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 58,
                              "end": 59
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 45,
                        "end": 60
                      }
                    }
                  },
                  "span": {
                    "start": 45,
                    "end": 60
                  }
                }
              ]
            }
          },
          "span": {
            "start": 39,
            "end": 61
          }
        }
      },
      "span": {
        "start": 39,
        "end": 62
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "B"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 63,
                      "end": 64
                    }
                  }
                },
                "span": {
                  "start": 63,
                  "end": 64
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 66,
                  "end": 67
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
                                        "count"
                                      ],
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 68,
                                        "end": 74
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 68,
                                    "end": 74
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
                                          "start": 75,
                                          "end": 77
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 75,
                                      "end": 77
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 68,
                              "end": 78
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 79,
                              "end": 80
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 68,
                        "end": 81
                      }
                    }
                  },
                  "span": {
                    "start": 68,
                    "end": 81
                  }
                }
              ]
            }
          },
          "span": {
            "start": 63,
            "end": 82
          }
        }
      },
      "span": {
        "start": 63,
        "end": 83
      }
    },
    {
      "kind": {
        "Expression": {
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
                      "start": 88,
                      "end": 89
                    }
                  }
                },
                "span": {
                  "start": 88,
                  "end": 89
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
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 90,
                                        "end": 97
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 90,
                                    "end": 97
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
                                          "start": 98,
                                          "end": 101
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 98,
                                      "end": 101
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 90,
                              "end": 102
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "p"
                            },
                            "span": {
                              "start": 104,
                              "end": 105
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 90,
                        "end": 105
                      }
                    }
                  },
                  "span": {
                    "start": 90,
                    "end": 105
                  }
                }
              ]
            }
          },
          "span": {
            "start": 84,
            "end": 106
          }
        }
      },
      "span": {
        "start": 84,
        "end": 107
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 108,
                  "end": 110
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
                                        "gettype"
                                      ],
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 111,
                                        "end": 119
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 111,
                                    "end": 119
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
                                          "start": 120,
                                          "end": 122
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 120,
                                      "end": 122
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 111,
                              "end": 123
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 124,
                              "end": 125
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 111,
                        "end": 126
                      }
                    }
                  },
                  "span": {
                    "start": 111,
                    "end": 126
                  }
                }
              ]
            }
          },
          "span": {
            "start": 108,
            "end": 127
          }
        }
      },
      "span": {
        "start": 108,
        "end": 128
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 138,
              "end": 139
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 141,
                  "end": 143
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 140,
                "end": 143
              }
            }
          ],
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
                              "f"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 151,
                              "end": 152
                            }
                          }
                        },
                        "span": {
                          "start": 151,
                          "end": 152
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
                                              "kind": "FullyQualified",
                                              "span": {
                                                "start": 153,
                                                "end": 160
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 153,
                                            "end": 160
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
                                      "start": 153,
                                      "end": 165
                                    }
                                  },
                                  "index": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 166,
                                      "end": 167
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 153,
                                "end": 168
                              }
                            }
                          },
                          "span": {
                            "start": 153,
                            "end": 168
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 151,
                    "end": 169
                  }
                }
              },
              "span": {
                "start": 151,
                "end": 170
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 129,
        "end": 172
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
                      "start": 173,
                      "end": 174
                    }
                  }
                },
                "span": {
                  "start": 173,
                  "end": 174
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
                                        "start": 175,
                                        "end": 181
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 175,
                                    "end": 181
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
                                          "start": 182,
                                          "end": 185
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 182,
                                      "end": 185
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 175,
                              "end": 186
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 187,
                              "end": 188
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 175,
                        "end": 189
                      }
                    }
                  },
                  "span": {
                    "start": 175,
                    "end": 189
                  }
                }
              ]
            }
          },
          "span": {
            "start": 173,
            "end": 190
          }
        }
      },
      "span": {
        "start": 173,
        "end": 191
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
                      "start": 192,
                      "end": 193
                    }
                  }
                },
                "span": {
                  "start": 192,
                  "end": 193
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
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 194,
                                  "end": 201
                                }
                              }
                            },
                            "span": {
                              "start": 194,
                              "end": 201
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
                                    "start": 202,
                                    "end": 205
                                  }
                                }
                              },
                              "span": {
                                "start": 202,
                                "end": 205
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 194,
                        "end": 206
                      }
                    }
                  },
                  "span": {
                    "start": 194,
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
  ],
  "span": {
    "start": 0,
    "end": 208
  }
}

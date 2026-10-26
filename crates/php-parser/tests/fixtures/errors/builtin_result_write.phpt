===source===
<?php
strlen("foo")[0] = 1;
\is_null($a)->b = 1;
COUNT($a)[] = 1;
array_key_exists($a, $b)[0] .= 1;
defined('A')[0]++;
unset(gettype($a)[0]);
[strval($a)[0]] = $b;
foreach ($b as intval($a)[0]) {}
$x = &strlen($a);
function f() { func_get_args()[0] = 1; }
===errors===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===php_error===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 2
===ast===
{
  "stmts": [
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
                                  "start": 6,
                                  "end": 12
                                }
                              }
                            },
                            "span": {
                              "start": 6,
                              "end": 12
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "String": "foo"
                                  },
                                  "span": {
                                    "start": 13,
                                    "end": 18
                                  }
                                }
                              },
                              "span": {
                                "start": 13,
                                "end": 18
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 19
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 25,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "is_null"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 28,
                                  "end": 36
                                }
                              }
                            },
                            "span": {
                              "start": 28,
                              "end": 36
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
                                    "start": 37,
                                    "end": 39
                                  }
                                }
                              },
                              "span": {
                                "start": 37,
                                "end": 39
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 40
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 42,
                        "end": 43
                      }
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 43
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 46,
                  "end": 47
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 47
          }
        }
      },
      "span": {
        "start": 28,
        "end": 48
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
                                  "COUNT"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 49,
                                  "end": 54
                                }
                              }
                            },
                            "span": {
                              "start": 49,
                              "end": 54
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
                                    "start": 55,
                                    "end": 57
                                  }
                                }
                              },
                              "span": {
                                "start": 55,
                                "end": 57
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 58
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 49,
                  "end": 60
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 63,
                  "end": 64
                }
              }
            }
          },
          "span": {
            "start": 49,
            "end": 64
          }
        }
      },
      "span": {
        "start": 49,
        "end": 65
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
                                  "array_key_exists"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 66,
                                  "end": 82
                                }
                              }
                            },
                            "span": {
                              "start": 66,
                              "end": 82
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
                                    "start": 83,
                                    "end": 85
                                  }
                                }
                              },
                              "span": {
                                "start": 83,
                                "end": 85
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
                                    "start": 87,
                                    "end": 89
                                  }
                                }
                              },
                              "span": {
                                "start": 87,
                                "end": 89
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 66,
                        "end": 90
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 91,
                        "end": 92
                      }
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 93
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 97,
                  "end": 98
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 98
          }
        }
      },
      "span": {
        "start": 66,
        "end": 99
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
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
                                  "start": 100,
                                  "end": 107
                                }
                              }
                            },
                            "span": {
                              "start": 100,
                              "end": 107
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "String": "A"
                                  },
                                  "span": {
                                    "start": 108,
                                    "end": 111
                                  }
                                }
                              },
                              "span": {
                                "start": 108,
                                "end": 111
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 100,
                        "end": 112
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 113,
                        "end": 114
                      }
                    }
                  }
                },
                "span": {
                  "start": 100,
                  "end": 115
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 100,
            "end": 117
          }
        }
      },
      "span": {
        "start": 100,
        "end": 118
      }
    },
    {
      "kind": {
        "Unset": [
          {
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
                              "start": 125,
                              "end": 132
                            }
                          }
                        },
                        "span": {
                          "start": 125,
                          "end": 132
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
                                "start": 133,
                                "end": 135
                              }
                            }
                          },
                          "span": {
                            "start": 133,
                            "end": 135
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 125,
                    "end": 136
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 137,
                    "end": 138
                  }
                }
              }
            },
            "span": {
              "start": 125,
              "end": 139
            }
          }
        ]
      },
      "span": {
        "start": 119,
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
                  "Array": [
                    {
                      "key": null,
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
                                            "strval"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 143,
                                            "end": 149
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 143,
                                        "end": 149
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
                                              "start": 150,
                                              "end": 152
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 150,
                                          "end": 152
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 143,
                                  "end": 153
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 154,
                                  "end": 155
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 143,
                            "end": 156
                          }
                        }
                      },
                      "span": {
                        "start": 143,
                        "end": 156
                      }
                    }
                  ]
                },
                "span": {
                  "start": 142,
                  "end": 157
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 160,
                  "end": 162
                }
              }
            }
          },
          "span": {
            "start": 142,
            "end": 162
          }
        }
      },
      "span": {
        "start": 142,
        "end": 163
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 173,
              "end": 175
            }
          },
          "key": null,
          "value": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "intval"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 179,
                              "end": 185
                            }
                          }
                        },
                        "span": {
                          "start": 179,
                          "end": 185
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
                                "start": 186,
                                "end": 188
                              }
                            }
                          },
                          "span": {
                            "start": 186,
                            "end": 188
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 179,
                    "end": 189
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 190,
                    "end": 191
                  }
                }
              }
            },
            "span": {
              "start": 179,
              "end": 192
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 194,
              "end": 196
            }
          }
        }
      },
      "span": {
        "start": 164,
        "end": 196
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 197,
                  "end": 199
                }
              },
              "op": "Assign",
              "value": {
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
                            "start": 203,
                            "end": 209
                          }
                        }
                      },
                      "span": {
                        "start": 203,
                        "end": 209
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
                              "start": 210,
                              "end": 212
                            }
                          }
                        },
                        "span": {
                          "start": 210,
                          "end": 212
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 203,
                  "end": 213
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 197,
            "end": 213
          }
        }
      },
      "span": {
        "start": 197,
        "end": 214
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 224,
              "end": 225
            }
          },
          "params": [],
          "body": [
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
                                          "start": 230,
                                          "end": 243
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 230,
                                      "end": 243
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 230,
                                "end": 245
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 246,
                                "end": 247
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 230,
                          "end": 248
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 251,
                          "end": 252
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 230,
                    "end": 252
                  }
                }
              },
              "span": {
                "start": 230,
                "end": 253
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 215,
        "end": 255
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 255
  }
}

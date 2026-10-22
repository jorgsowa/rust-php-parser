===source===
<?php
function g() {
    $a = yield ?? 1;
    $b = yield ? 1 : 2;
    $c = yield ?: 3;
    $d = [yield => 1];
    foreach (yield as $v) {}
    foreach (yield as $k => $v) {}
    switch (1) { case yield: break; }
    $e = $x ? yield : 2;
    $f = yield instanceof A;
    $g = yield and 1;
    $i = [yield, yield => yield];
    $j = match (1) { yield => yield, };
}
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=>' (T_DOUBLE_ARROW) in Standard input code on line 14
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 15,
              "end": 16
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
                          "Variable": "a"
                        },
                        "span": {
                          "start": 25,
                          "end": 27
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "NullCoalesce": {
                            "left": {
                              "kind": {
                                "Yield": {
                                  "key": null,
                                  "value": null,
                                  "is_from": false
                                }
                              },
                              "span": {
                                "start": 30,
                                "end": 35
                              }
                            },
                            "right": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 39,
                                "end": 40
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 30,
                          "end": 40
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 40
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 41
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
                          "start": 46,
                          "end": 48
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Ternary": {
                            "condition": {
                              "kind": {
                                "Yield": {
                                  "key": null,
                                  "value": null,
                                  "is_from": false
                                }
                              },
                              "span": {
                                "start": 51,
                                "end": 56
                              }
                            },
                            "then_expr": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 59,
                                "end": 60
                              }
                            },
                            "else_expr": {
                              "kind": {
                                "Int": 2
                              },
                              "span": {
                                "start": 63,
                                "end": 64
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 51,
                          "end": 64
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 64
                  }
                }
              },
              "span": {
                "start": 46,
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
                          "Variable": "c"
                        },
                        "span": {
                          "start": 70,
                          "end": 72
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Ternary": {
                            "condition": {
                              "kind": {
                                "Yield": {
                                  "key": null,
                                  "value": null,
                                  "is_from": false
                                }
                              },
                              "span": {
                                "start": 75,
                                "end": 80
                              }
                            },
                            "then_expr": null,
                            "else_expr": {
                              "kind": {
                                "Int": 3
                              },
                              "span": {
                                "start": 84,
                                "end": 85
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 75,
                          "end": 85
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 70,
                    "end": 85
                  }
                }
              },
              "span": {
                "start": 70,
                "end": 86
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
                          "start": 91,
                          "end": 93
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": {
                                "kind": {
                                  "Yield": {
                                    "key": null,
                                    "value": null,
                                    "is_from": false
                                  }
                                },
                                "span": {
                                  "start": 97,
                                  "end": 102
                                }
                              },
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 106,
                                    "end": 107
                                  }
                                }
                              },
                              "span": {
                                "start": 97,
                                "end": 107
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 96,
                          "end": 108
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 91,
                    "end": 108
                  }
                }
              },
              "span": {
                "start": 91,
                "end": 109
              }
            },
            {
              "kind": {
                "Foreach": {
                  "expr": {
                    "kind": {
                      "Yield": {
                        "key": null,
                        "value": null,
                        "is_from": false
                      }
                    },
                    "span": {
                      "start": 123,
                      "end": 128
                    }
                  },
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "v"
                    },
                    "span": {
                      "start": 132,
                      "end": 134
                    }
                  },
                  "body": {
                    "kind": {
                      "Block": []
                    },
                    "span": {
                      "start": 136,
                      "end": 138
                    }
                  }
                }
              },
              "span": {
                "start": 114,
                "end": 138
              }
            },
            {
              "kind": {
                "Foreach": {
                  "expr": {
                    "kind": {
                      "Yield": {
                        "key": null,
                        "value": null,
                        "is_from": false
                      }
                    },
                    "span": {
                      "start": 152,
                      "end": 157
                    }
                  },
                  "key": {
                    "kind": {
                      "Variable": "k"
                    },
                    "span": {
                      "start": 161,
                      "end": 163
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "v"
                    },
                    "span": {
                      "start": 167,
                      "end": 169
                    }
                  },
                  "body": {
                    "kind": {
                      "Block": []
                    },
                    "span": {
                      "start": 171,
                      "end": 173
                    }
                  }
                }
              },
              "span": {
                "start": 143,
                "end": 173
              }
            },
            {
              "kind": {
                "Switch": {
                  "expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 186,
                      "end": 187
                    }
                  },
                  "cases": [
                    {
                      "value": {
                        "kind": {
                          "Yield": {
                            "key": null,
                            "value": null,
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 196,
                          "end": 201
                        }
                      },
                      "body": [
                        {
                          "kind": {
                            "Break": null
                          },
                          "span": {
                            "start": 203,
                            "end": 209
                          }
                        }
                      ],
                      "span": {
                        "start": 191,
                        "end": 209
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 178,
                "end": 211
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
                          "start": 216,
                          "end": 218
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Ternary": {
                            "condition": {
                              "kind": {
                                "Variable": "x"
                              },
                              "span": {
                                "start": 221,
                                "end": 223
                              }
                            },
                            "then_expr": {
                              "kind": {
                                "Yield": {
                                  "key": null,
                                  "value": null,
                                  "is_from": false
                                }
                              },
                              "span": {
                                "start": 226,
                                "end": 231
                              }
                            },
                            "else_expr": {
                              "kind": {
                                "Int": 2
                              },
                              "span": {
                                "start": 234,
                                "end": 235
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 221,
                          "end": 235
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 216,
                    "end": 235
                  }
                }
              },
              "span": {
                "start": 216,
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
                          "Variable": "f"
                        },
                        "span": {
                          "start": 241,
                          "end": 243
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Yield": {
                                  "key": null,
                                  "value": null,
                                  "is_from": false
                                }
                              },
                              "span": {
                                "start": 246,
                                "end": 251
                              }
                            },
                            "op": "Instanceof",
                            "right": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "A"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 263,
                                    "end": 264
                                  }
                                }
                              },
                              "span": {
                                "start": 263,
                                "end": 264
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 246,
                          "end": 264
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 241,
                    "end": 264
                  }
                }
              },
              "span": {
                "start": 241,
                "end": 265
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "Assign": {
                            "target": {
                              "kind": {
                                "Variable": "g"
                              },
                              "span": {
                                "start": 270,
                                "end": 272
                              }
                            },
                            "op": "Assign",
                            "value": {
                              "kind": {
                                "Yield": {
                                  "key": null,
                                  "value": null,
                                  "is_from": false
                                }
                              },
                              "span": {
                                "start": 275,
                                "end": 280
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 270,
                          "end": 280
                        }
                      },
                      "op": "LogicalAnd",
                      "right": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 285,
                          "end": 286
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 270,
                    "end": 286
                  }
                }
              },
              "span": {
                "start": 270,
                "end": 287
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "i"
                        },
                        "span": {
                          "start": 292,
                          "end": 294
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Yield": {
                                      "key": null,
                                      "value": null,
                                      "is_from": false
                                    }
                                  },
                                  "span": {
                                    "start": 298,
                                    "end": 303
                                  }
                                }
                              },
                              "span": {
                                "start": 298,
                                "end": 303
                              }
                            },
                            {
                              "key": {
                                "kind": {
                                  "Yield": {
                                    "key": null,
                                    "value": null,
                                    "is_from": false
                                  }
                                },
                                "span": {
                                  "start": 305,
                                  "end": 310
                                }
                              },
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Yield": {
                                      "key": null,
                                      "value": null,
                                      "is_from": false
                                    }
                                  },
                                  "span": {
                                    "start": 314,
                                    "end": 319
                                  }
                                }
                              },
                              "span": {
                                "start": 305,
                                "end": 319
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 297,
                          "end": 320
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 292,
                    "end": 320
                  }
                }
              },
              "span": {
                "start": 292,
                "end": 321
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "j"
                        },
                        "span": {
                          "start": 326,
                          "end": 328
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Match": {
                            "subject": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 338,
                                "end": 339
                              }
                            },
                            "arms": [
                              {
                                "conditions": [
                                  {
                                    "kind": {
                                      "Yield": {
                                        "key": null,
                                        "value": null,
                                        "is_from": false
                                      }
                                    },
                                    "span": {
                                      "start": 343,
                                      "end": 348
                                    }
                                  }
                                ],
                                "body": {
                                  "kind": {
                                    "Yield": {
                                      "key": null,
                                      "value": null,
                                      "is_from": false
                                    }
                                  },
                                  "span": {
                                    "start": 352,
                                    "end": 357
                                  }
                                },
                                "span": {
                                  "start": 343,
                                  "end": 357
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 331,
                          "end": 360
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 326,
                    "end": 360
                  }
                }
              },
              "span": {
                "start": 326,
                "end": 361
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 363
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 363
  }
}

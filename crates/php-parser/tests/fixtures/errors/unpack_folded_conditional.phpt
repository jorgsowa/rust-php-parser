===source===
<?php
$a = [...(false ? [1] : 2)];
$a = [...(1 < 2 ? 1 : [])];
$a = [...(1 ?: 2)];
$a = [...([] ?: 2)];
$a = [...(null ?? 2)];
$a = [...(1 ?? [])];
$a = [...((1 ?: 2) + 1)];
const C = [...(null ?? 1.5)];
===errors===
Only arrays and Traversables can be unpacked, int given
Only arrays and Traversables can be unpacked, int given
Only arrays and Traversables can be unpacked, int given
Only arrays and Traversables can be unpacked, int given
Only arrays and Traversables can be unpacked, int given
Only arrays and Traversables can be unpacked, int given
Only arrays and Traversables can be unpacked, int given
Only arrays and Traversables can be unpacked, float given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Only arrays and Traversables can be unpacked, int given in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Bool": false
                                    },
                                    "span": {
                                      "start": 16,
                                      "end": 21
                                    }
                                  },
                                  "then_expr": {
                                    "kind": {
                                      "Array": [
                                        {
                                          "key": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Int": 1
                                              },
                                              "span": {
                                                "start": 25,
                                                "end": 26
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 25,
                                            "end": 26
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 24,
                                      "end": 27
                                    }
                                  },
                                  "else_expr": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 30,
                                      "end": 31
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 16,
                                "end": 31
                              }
                            }
                          },
                          "span": {
                            "start": 15,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 32
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    },
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
                  "start": 35,
                  "end": 37
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "Int": 1
                                          },
                                          "span": {
                                            "start": 45,
                                            "end": 46
                                          }
                                        },
                                        "op": "Less",
                                        "right": {
                                          "kind": {
                                            "Int": 2
                                          },
                                          "span": {
                                            "start": 49,
                                            "end": 50
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 45,
                                      "end": 50
                                    }
                                  },
                                  "then_expr": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 53,
                                      "end": 54
                                    }
                                  },
                                  "else_expr": {
                                    "kind": {
                                      "Array": []
                                    },
                                    "span": {
                                      "start": 57,
                                      "end": 59
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 45,
                                "end": 59
                              }
                            }
                          },
                          "span": {
                            "start": 44,
                            "end": 60
                          }
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 60
                      }
                    }
                  ]
                },
                "span": {
                  "start": 40,
                  "end": 61
                }
              }
            }
          },
          "span": {
            "start": 35,
            "end": 61
          }
        }
      },
      "span": {
        "start": 35,
        "end": 62
      }
    },
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
                  "start": 63,
                  "end": 65
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 73,
                                      "end": 74
                                    }
                                  },
                                  "then_expr": null,
                                  "else_expr": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 78,
                                      "end": 79
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 73,
                                "end": 79
                              }
                            }
                          },
                          "span": {
                            "start": 72,
                            "end": 80
                          }
                        }
                      },
                      "span": {
                        "start": 69,
                        "end": 80
                      }
                    }
                  ]
                },
                "span": {
                  "start": 68,
                  "end": 81
                }
              }
            }
          },
          "span": {
            "start": 63,
            "end": 81
          }
        }
      },
      "span": {
        "start": 63,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 83,
                  "end": 85
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Array": []
                                    },
                                    "span": {
                                      "start": 93,
                                      "end": 95
                                    }
                                  },
                                  "then_expr": null,
                                  "else_expr": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 99,
                                      "end": 100
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 93,
                                "end": 100
                              }
                            }
                          },
                          "span": {
                            "start": 92,
                            "end": 101
                          }
                        }
                      },
                      "span": {
                        "start": 89,
                        "end": 101
                      }
                    }
                  ]
                },
                "span": {
                  "start": 88,
                  "end": 102
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 102
          }
        }
      },
      "span": {
        "start": 83,
        "end": 103
      }
    },
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
                  "start": 104,
                  "end": 106
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "NullCoalesce": {
                                  "left": {
                                    "kind": "Null",
                                    "span": {
                                      "start": 114,
                                      "end": 118
                                    }
                                  },
                                  "right": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 122,
                                      "end": 123
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 114,
                                "end": 123
                              }
                            }
                          },
                          "span": {
                            "start": 113,
                            "end": 124
                          }
                        }
                      },
                      "span": {
                        "start": 110,
                        "end": 124
                      }
                    }
                  ]
                },
                "span": {
                  "start": 109,
                  "end": 125
                }
              }
            }
          },
          "span": {
            "start": 104,
            "end": 125
          }
        }
      },
      "span": {
        "start": 104,
        "end": 126
      }
    },
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
                  "start": 127,
                  "end": 129
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "NullCoalesce": {
                                  "left": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 137,
                                      "end": 138
                                    }
                                  },
                                  "right": {
                                    "kind": {
                                      "Array": []
                                    },
                                    "span": {
                                      "start": 142,
                                      "end": 144
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 137,
                                "end": 144
                              }
                            }
                          },
                          "span": {
                            "start": 136,
                            "end": 145
                          }
                        }
                      },
                      "span": {
                        "start": 133,
                        "end": 145
                      }
                    }
                  ]
                },
                "span": {
                  "start": 132,
                  "end": 146
                }
              }
            }
          },
          "span": {
            "start": 127,
            "end": 146
          }
        }
      },
      "span": {
        "start": 127,
        "end": 147
      }
    },
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
                  "start": 148,
                  "end": 150
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Ternary": {
                                            "condition": {
                                              "kind": {
                                                "Int": 1
                                              },
                                              "span": {
                                                "start": 159,
                                                "end": 160
                                              }
                                            },
                                            "then_expr": null,
                                            "else_expr": {
                                              "kind": {
                                                "Int": 2
                                              },
                                              "span": {
                                                "start": 164,
                                                "end": 165
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 159,
                                          "end": 165
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 158,
                                      "end": 166
                                    }
                                  },
                                  "op": "Add",
                                  "right": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 169,
                                      "end": 170
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 158,
                                "end": 170
                              }
                            }
                          },
                          "span": {
                            "start": 157,
                            "end": 171
                          }
                        }
                      },
                      "span": {
                        "start": 154,
                        "end": 171
                      }
                    }
                  ]
                },
                "span": {
                  "start": 153,
                  "end": 172
                }
              }
            }
          },
          "span": {
            "start": 148,
            "end": 172
          }
        }
      },
      "span": {
        "start": 148,
        "end": 173
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 180,
                "end": 181
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": null,
                    "kind": {
                      "Spread": {
                        "kind": {
                          "Parenthesized": {
                            "kind": {
                              "NullCoalesce": {
                                "left": {
                                  "kind": "Null",
                                  "span": {
                                    "start": 189,
                                    "end": 193
                                  }
                                },
                                "right": {
                                  "kind": {
                                    "Float": 1.5
                                  },
                                  "span": {
                                    "start": 197,
                                    "end": 200
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 189,
                              "end": 200
                            }
                          }
                        },
                        "span": {
                          "start": 188,
                          "end": 201
                        }
                      }
                    },
                    "span": {
                      "start": 185,
                      "end": 201
                    }
                  }
                ]
              },
              "span": {
                "start": 184,
                "end": 202
              }
            },
            "attributes": [],
            "span": {
              "start": 180,
              "end": 202
            }
          }
        ]
      },
      "span": {
        "start": 174,
        "end": 203
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 203
  }
}

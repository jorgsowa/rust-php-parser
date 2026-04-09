===source===
<?php
if ($x > 0) {
    echo 'positive';
} elseif ($x < 0) {
    echo 'negative';
} else {
    echo 'zero';
}

while ($i < 10) {
    $i = $i + 1;
}

for ($i = 0; $i < 10; $i++) {
    echo $i;
}

foreach ($items as $item) {
    echo $item;
}

foreach ($map as $key => $value) {
    echo $key;
    echo $value;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 10,
                    "end": 12,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                "op": "Greater",
                "right": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 15,
                    "end": 16,
                    "start_line": 2,
                    "start_col": 9
                  }
                }
              }
            },
            "span": {
              "start": 10,
              "end": 16,
              "start_line": 2,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "positive"
                        },
                        "span": {
                          "start": 29,
                          "end": 39,
                          "start_line": 3,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 24,
                    "end": 41,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 18,
              "end": 42,
              "start_line": 2,
              "start_col": 12
            }
          },
          "elseif_branches": [
            {
              "condition": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 51,
                        "end": 53,
                        "start_line": 4,
                        "start_col": 10
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 56,
                        "end": 57,
                        "start_line": 4,
                        "start_col": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 51,
                  "end": 57,
                  "start_line": 4,
                  "start_col": 10
                }
              },
              "body": {
                "kind": {
                  "Block": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "negative"
                            },
                            "span": {
                              "start": 70,
                              "end": 80,
                              "start_line": 5,
                              "start_col": 9
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 65,
                        "end": 82,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  ]
                },
                "span": {
                  "start": 59,
                  "end": 83,
                  "start_line": 4,
                  "start_col": 18
                }
              },
              "span": {
                "start": 50,
                "end": 83,
                "start_line": 4,
                "start_col": 9
              }
            }
          ],
          "else_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "zero"
                        },
                        "span": {
                          "start": 100,
                          "end": 106,
                          "start_line": 7,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 95,
                    "end": 108,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 89,
              "end": 109,
              "start_line": 6,
              "start_col": 7
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 109,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "i"
                  },
                  "span": {
                    "start": 118,
                    "end": 120,
                    "start_line": 10,
                    "start_col": 7
                  }
                },
                "op": "Less",
                "right": {
                  "kind": {
                    "Int": 10
                  },
                  "span": {
                    "start": 123,
                    "end": 125,
                    "start_line": 10,
                    "start_col": 12
                  }
                }
              }
            },
            "span": {
              "start": 118,
              "end": 125,
              "start_line": 10,
              "start_col": 7
            }
          },
          "body": {
            "kind": {
              "Block": [
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
                              "start": 133,
                              "end": 135,
                              "start_line": 11,
                              "start_col": 4
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "i"
                                  },
                                  "span": {
                                    "start": 138,
                                    "end": 140,
                                    "start_line": 11,
                                    "start_col": 9
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 143,
                                    "end": 144,
                                    "start_line": 11,
                                    "start_col": 14
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 138,
                              "end": 144,
                              "start_line": 11,
                              "start_col": 9
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 133,
                        "end": 144,
                        "start_line": 11,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 133,
                    "end": 146,
                    "start_line": 11,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 127,
              "end": 147,
              "start_line": 10,
              "start_col": 16
            }
          }
        }
      },
      "span": {
        "start": 111,
        "end": 147,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 154,
                      "end": 156,
                      "start_line": 14,
                      "start_col": 5
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 159,
                      "end": 160,
                      "start_line": 14,
                      "start_col": 10
                    }
                  }
                }
              },
              "span": {
                "start": 154,
                "end": 160,
                "start_line": 14,
                "start_col": 5
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 162,
                      "end": 164,
                      "start_line": 14,
                      "start_col": 13
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 167,
                      "end": 169,
                      "start_line": 14,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 162,
                "end": 169,
                "start_line": 14,
                "start_col": 13
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 171,
                      "end": 173,
                      "start_line": 14,
                      "start_col": 22
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 171,
                "end": 175,
                "start_line": 14,
                "start_col": 22
              }
            }
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "i"
                        },
                        "span": {
                          "start": 188,
                          "end": 190,
                          "start_line": 15,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 183,
                    "end": 192,
                    "start_line": 15,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 177,
              "end": 193,
              "start_line": 14,
              "start_col": 28
            }
          }
        }
      },
      "span": {
        "start": 149,
        "end": 193,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "items"
            },
            "span": {
              "start": 204,
              "end": 210,
              "start_line": 18,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "item"
            },
            "span": {
              "start": 214,
              "end": 219,
              "start_line": 18,
              "start_col": 19
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "item"
                        },
                        "span": {
                          "start": 232,
                          "end": 237,
                          "start_line": 19,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 227,
                    "end": 239,
                    "start_line": 19,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 221,
              "end": 240,
              "start_line": 18,
              "start_col": 26
            }
          }
        }
      },
      "span": {
        "start": 195,
        "end": 240,
        "start_line": 18,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "map"
            },
            "span": {
              "start": 251,
              "end": 255,
              "start_line": 22,
              "start_col": 9
            }
          },
          "key": {
            "kind": {
              "Variable": "key"
            },
            "span": {
              "start": 259,
              "end": 263,
              "start_line": 22,
              "start_col": 17
            }
          },
          "value": {
            "kind": {
              "Variable": "value"
            },
            "span": {
              "start": 267,
              "end": 273,
              "start_line": 22,
              "start_col": 25
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "key"
                        },
                        "span": {
                          "start": 286,
                          "end": 290,
                          "start_line": 23,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 281,
                    "end": 296,
                    "start_line": 23,
                    "start_col": 4
                  }
                },
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "value"
                        },
                        "span": {
                          "start": 301,
                          "end": 307,
                          "start_line": 24,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 296,
                    "end": 309,
                    "start_line": 24,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 275,
              "end": 310,
              "start_line": 22,
              "start_col": 33
            }
          }
        }
      },
      "span": {
        "start": 242,
        "end": 310,
        "start_line": 22,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 310,
    "start_line": 1,
    "start_col": 0
  }
}

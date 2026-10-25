===source===
<?php
$a = [] + [1];
$b = [] - "a";
$c = [] / 0.5;
$d = [] / " 2 ";
$e = [1 % 0] - 1;
$f = [$x] - 1;
$g = true || [] - 1;
$h = false && ~null;
$i = ~"a";
$j = (int)[] - 1;
$k = [] % 2;
$l = [] ** 2;
$m = [] | 1;
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "op": "Add",
                    "right": {
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
                                  "start": 17,
                                  "end": 18
                                }
                              }
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 16,
                        "end": 19
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
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
                  "start": 21,
                  "end": 23
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 26,
                        "end": 28
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 31,
                        "end": 34
                      }
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 34
          }
        }
      },
      "span": {
        "start": 21,
        "end": 35
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
                  "start": 36,
                  "end": 38
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 41,
                        "end": 43
                      }
                    },
                    "op": "Div",
                    "right": {
                      "kind": {
                        "Float": 0.5
                      },
                      "span": {
                        "start": 46,
                        "end": 49
                      }
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 49
          }
        }
      },
      "span": {
        "start": 36,
        "end": 50
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
                  "start": 51,
                  "end": 53
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 56,
                        "end": 58
                      }
                    },
                    "op": "Div",
                    "right": {
                      "kind": {
                        "String": " 2 "
                      },
                      "span": {
                        "start": 61,
                        "end": 66
                      }
                    }
                  }
                },
                "span": {
                  "start": 56,
                  "end": 66
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 66
          }
        }
      },
      "span": {
        "start": 51,
        "end": 67
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
                  "start": 68,
                  "end": 70
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 74,
                                        "end": 75
                                      }
                                    },
                                    "op": "Mod",
                                    "right": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 78,
                                        "end": 79
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 74,
                                  "end": 79
                                }
                              }
                            },
                            "span": {
                              "start": 74,
                              "end": 79
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 73,
                        "end": 80
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 83,
                        "end": 84
                      }
                    }
                  }
                },
                "span": {
                  "start": 73,
                  "end": 84
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 84
          }
        }
      },
      "span": {
        "start": 68,
        "end": 85
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
                  "start": 86,
                  "end": 88
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 92,
                                  "end": 94
                                }
                              }
                            },
                            "span": {
                              "start": 92,
                              "end": 94
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 91,
                        "end": 95
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 98,
                        "end": 99
                      }
                    }
                  }
                },
                "span": {
                  "start": 91,
                  "end": 99
                }
              }
            }
          },
          "span": {
            "start": 86,
            "end": 99
          }
        }
      },
      "span": {
        "start": 86,
        "end": 100
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
                  "start": 101,
                  "end": 103
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 106,
                        "end": 110
                      }
                    },
                    "op": "BooleanOr",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Array": []
                            },
                            "span": {
                              "start": 114,
                              "end": 116
                            }
                          },
                          "op": "Sub",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 119,
                              "end": 120
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 114,
                        "end": 120
                      }
                    }
                  }
                },
                "span": {
                  "start": 106,
                  "end": 120
                }
              }
            }
          },
          "span": {
            "start": 101,
            "end": 120
          }
        }
      },
      "span": {
        "start": 101,
        "end": 121
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "h"
                },
                "span": {
                  "start": 122,
                  "end": 124
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Bool": false
                      },
                      "span": {
                        "start": 127,
                        "end": 132
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "BitwiseNot",
                          "operand": {
                            "kind": "Null",
                            "span": {
                              "start": 137,
                              "end": 141
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 136,
                        "end": 141
                      }
                    }
                  }
                },
                "span": {
                  "start": 127,
                  "end": 141
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 141
          }
        }
      },
      "span": {
        "start": 122,
        "end": 142
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
                  "start": 143,
                  "end": 145
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BitwiseNot",
                    "operand": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 149,
                        "end": 152
                      }
                    }
                  }
                },
                "span": {
                  "start": 148,
                  "end": 152
                }
              }
            }
          },
          "span": {
            "start": 143,
            "end": 152
          }
        }
      },
      "span": {
        "start": 143,
        "end": 153
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
                  "start": 154,
                  "end": 156
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Cast": [
                          "Int",
                          {
                            "kind": {
                              "Array": []
                            },
                            "span": {
                              "start": 164,
                              "end": 166
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 159,
                        "end": 166
                      }
                    },
                    "op": "Sub",
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
                  "start": 159,
                  "end": 170
                }
              }
            }
          },
          "span": {
            "start": 154,
            "end": 170
          }
        }
      },
      "span": {
        "start": 154,
        "end": 171
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "k"
                },
                "span": {
                  "start": 172,
                  "end": 174
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 177,
                        "end": 179
                      }
                    },
                    "op": "Mod",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 182,
                        "end": 183
                      }
                    }
                  }
                },
                "span": {
                  "start": 177,
                  "end": 183
                }
              }
            }
          },
          "span": {
            "start": 172,
            "end": 183
          }
        }
      },
      "span": {
        "start": 172,
        "end": 184
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "l"
                },
                "span": {
                  "start": 185,
                  "end": 187
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 190,
                        "end": 192
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 196,
                        "end": 197
                      }
                    }
                  }
                },
                "span": {
                  "start": 190,
                  "end": 197
                }
              }
            }
          },
          "span": {
            "start": 185,
            "end": 197
          }
        }
      },
      "span": {
        "start": 185,
        "end": 198
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "m"
                },
                "span": {
                  "start": 199,
                  "end": 201
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 204,
                        "end": 206
                      }
                    },
                    "op": "BitwiseOr",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 209,
                        "end": 210
                      }
                    }
                  }
                },
                "span": {
                  "start": 204,
                  "end": 210
                }
              }
            }
          },
          "span": {
            "start": 199,
            "end": 210
          }
        }
      },
      "span": {
        "start": 199,
        "end": 211
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 211
  }
}

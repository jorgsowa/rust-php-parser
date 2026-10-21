===source===
<?php
$a = (int
);
$b = (/*c*/int);
$c = (int // c
);
$d = (	int	)$x;
$e = (  STRING )$x;
$h = (int /* c */);
$i = (# c
float);
$j = (int);
$k = clone (object
);
$l = clone ( object )$x;
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
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 12,
                          "end": 15
                        }
                      }
                    },
                    "span": {
                      "start": 12,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
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
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 19,
                  "end": 21
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 30,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 33
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 34
          }
        }
      },
      "span": {
        "start": 19,
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
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 42,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 42,
                      "end": 45
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 52
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 52
          }
        }
      },
      "span": {
        "start": 36,
        "end": 53
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
                  "start": 54,
                  "end": 56
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Cast": [
                    "Int",
                    {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 66,
                        "end": 68
                      }
                    }
                  ]
                },
                "span": {
                  "start": 59,
                  "end": 68
                }
              }
            }
          },
          "span": {
            "start": 54,
            "end": 68
          }
        }
      },
      "span": {
        "start": 54,
        "end": 69
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
                  "start": 70,
                  "end": 72
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Cast": [
                    "String",
                    {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 86,
                        "end": 88
                      }
                    }
                  ]
                },
                "span": {
                  "start": 75,
                  "end": 88
                }
              }
            }
          },
          "span": {
            "start": 70,
            "end": 88
          }
        }
      },
      "span": {
        "start": 70,
        "end": 89
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
                  "start": 90,
                  "end": 92
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 96,
                          "end": 99
                        }
                      }
                    },
                    "span": {
                      "start": 96,
                      "end": 99
                    }
                  }
                },
                "span": {
                  "start": 95,
                  "end": 108
                }
              }
            }
          },
          "span": {
            "start": 90,
            "end": 108
          }
        }
      },
      "span": {
        "start": 90,
        "end": 109
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
                  "start": 110,
                  "end": 112
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "float"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 120,
                          "end": 125
                        }
                      }
                    },
                    "span": {
                      "start": 120,
                      "end": 125
                    }
                  }
                },
                "span": {
                  "start": 115,
                  "end": 126
                }
              }
            }
          },
          "span": {
            "start": 110,
            "end": 126
          }
        }
      },
      "span": {
        "start": 110,
        "end": 127
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
                  "start": 128,
                  "end": 130
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 135,
                          "end": 138
                        }
                      }
                    },
                    "span": {
                      "start": 135,
                      "end": 138
                    }
                  }
                },
                "span": {
                  "start": 133,
                  "end": 139
                }
              }
            }
          },
          "span": {
            "start": 128,
            "end": 139
          }
        }
      },
      "span": {
        "start": 128,
        "end": 140
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
                  "start": 141,
                  "end": 143
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "object"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 153,
                          "end": 159
                        }
                      }
                    },
                    "span": {
                      "start": 153,
                      "end": 159
                    }
                  }
                },
                "span": {
                  "start": 146,
                  "end": 161
                }
              }
            }
          },
          "span": {
            "start": 141,
            "end": 161
          }
        }
      },
      "span": {
        "start": 141,
        "end": 162
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
                  "start": 163,
                  "end": 165
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "Cast": [
                        "Object",
                        {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 184,
                            "end": 186
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 174,
                      "end": 186
                    }
                  }
                },
                "span": {
                  "start": 168,
                  "end": 186
                }
              }
            }
          },
          "span": {
            "start": 163,
            "end": 186
          }
        }
      },
      "span": {
        "start": 163,
        "end": 187
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 187
  }
}

===source===
<?php
// PHP's simple-interpolation integer rule: only "0" or [1-9][0-9]*
// Leading-zero forms and -0 are string keys, not integers.
"$a[0]";
"$a[1]";
"$a[42]";
"$a[-1]";
"$a[-42]";
"$a[-0]";
"$a[-00]";
"$a[00]";
"$a[07]";
"$a[-0x0]";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 135,
                          "end": 137
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 138,
                          "end": 139
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 135,
                    "end": 140
                  }
                }
              }
            ]
          },
          "span": {
            "start": 134,
            "end": 141
          }
        }
      },
      "span": {
        "start": 134,
        "end": 142
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 144,
                          "end": 146
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 147,
                          "end": 148
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 144,
                    "end": 149
                  }
                }
              }
            ]
          },
          "span": {
            "start": 143,
            "end": 150
          }
        }
      },
      "span": {
        "start": 143,
        "end": 151
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 153,
                          "end": 155
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 42
                        },
                        "span": {
                          "start": 156,
                          "end": 158
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 153,
                    "end": 159
                  }
                }
              }
            ]
          },
          "span": {
            "start": 152,
            "end": 160
          }
        }
      },
      "span": {
        "start": 152,
        "end": 161
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 163,
                          "end": 165
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": -1
                        },
                        "span": {
                          "start": 166,
                          "end": 168
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 163,
                    "end": 169
                  }
                }
              }
            ]
          },
          "span": {
            "start": 162,
            "end": 170
          }
        }
      },
      "span": {
        "start": 162,
        "end": 171
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 173,
                          "end": 175
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": -42
                        },
                        "span": {
                          "start": 176,
                          "end": 179
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 173,
                    "end": 180
                  }
                }
              }
            ]
          },
          "span": {
            "start": 172,
            "end": 181
          }
        }
      },
      "span": {
        "start": 172,
        "end": 182
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 184,
                          "end": 186
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "-0"
                        },
                        "span": {
                          "start": 187,
                          "end": 189
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 184,
                    "end": 190
                  }
                }
              }
            ]
          },
          "span": {
            "start": 183,
            "end": 191
          }
        }
      },
      "span": {
        "start": 183,
        "end": 192
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 194,
                          "end": 196
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "-00"
                        },
                        "span": {
                          "start": 197,
                          "end": 200
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 194,
                    "end": 201
                  }
                }
              }
            ]
          },
          "span": {
            "start": 193,
            "end": 202
          }
        }
      },
      "span": {
        "start": 193,
        "end": 203
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 205,
                          "end": 207
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "00"
                        },
                        "span": {
                          "start": 208,
                          "end": 210
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 205,
                    "end": 211
                  }
                }
              }
            ]
          },
          "span": {
            "start": 204,
            "end": 212
          }
        }
      },
      "span": {
        "start": 204,
        "end": 213
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 215,
                          "end": 217
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "07"
                        },
                        "span": {
                          "start": 218,
                          "end": 220
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 215,
                    "end": 221
                  }
                }
              }
            ]
          },
          "span": {
            "start": 214,
            "end": 222
          }
        }
      },
      "span": {
        "start": 214,
        "end": 223
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 225,
                          "end": 227
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "-0x0"
                        },
                        "span": {
                          "start": 228,
                          "end": 232
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 225,
                    "end": 233
                  }
                }
              }
            ]
          },
          "span": {
            "start": 224,
            "end": 234
          }
        }
      },
      "span": {
        "start": 224,
        "end": 235
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 235
  }
}

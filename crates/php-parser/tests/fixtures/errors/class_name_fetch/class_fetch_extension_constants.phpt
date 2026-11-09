===source===
<?php
(HASH_HMAC)::class;
(MT_RAND_MT19937)::class;
(PCRE_VERSION_MAJOR)::class;
(INI_ALL)::class;
(DIRECTORY_SEPARATOR)::class;
(STREAM_CLIENT_CONNECT)::class;
(MHASH_SHA1)::class;
(MT_RAND_PHP)::class;
(E_STRICT)::class;
(SORT_LOCALE_STRING)::class;
(LC_ALL)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
===errors 8.0-8.2===
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on string
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
===errors 8.3===
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on string
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
===errors 8.4===
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on string
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
===errors 8.5===
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on string
Cannot use "::class" on int
Cannot use "::class" on int
===errors >=8.6===
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on string
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on int in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "HASH_HMAC"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 16
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 19,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "MT_RAND_MT19937"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 42
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 42
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 43
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 45,
                  "end": 50
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 50
          }
        }
      },
      "span": {
        "start": 26,
        "end": 51
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "PCRE_VERSION_MAJOR"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 53,
                          "end": 71
                        }
                      }
                    },
                    "span": {
                      "start": 53,
                      "end": 71
                    }
                  }
                },
                "span": {
                  "start": 52,
                  "end": 72
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 74,
                  "end": 79
                }
              }
            }
          },
          "span": {
            "start": 52,
            "end": 79
          }
        }
      },
      "span": {
        "start": 52,
        "end": 80
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "INI_ALL"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 82,
                          "end": 89
                        }
                      }
                    },
                    "span": {
                      "start": 82,
                      "end": 89
                    }
                  }
                },
                "span": {
                  "start": 81,
                  "end": 90
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 92,
                  "end": 97
                }
              }
            }
          },
          "span": {
            "start": 81,
            "end": 97
          }
        }
      },
      "span": {
        "start": 81,
        "end": 98
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "DIRECTORY_SEPARATOR"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 100,
                          "end": 119
                        }
                      }
                    },
                    "span": {
                      "start": 100,
                      "end": 119
                    }
                  }
                },
                "span": {
                  "start": 99,
                  "end": 120
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 122,
                  "end": 127
                }
              }
            }
          },
          "span": {
            "start": 99,
            "end": 127
          }
        }
      },
      "span": {
        "start": 99,
        "end": 128
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "STREAM_CLIENT_CONNECT"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 130,
                          "end": 151
                        }
                      }
                    },
                    "span": {
                      "start": 130,
                      "end": 151
                    }
                  }
                },
                "span": {
                  "start": 129,
                  "end": 152
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 154,
                  "end": 159
                }
              }
            }
          },
          "span": {
            "start": 129,
            "end": 159
          }
        }
      },
      "span": {
        "start": 129,
        "end": 160
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "MHASH_SHA1"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 162,
                          "end": 172
                        }
                      }
                    },
                    "span": {
                      "start": 162,
                      "end": 172
                    }
                  }
                },
                "span": {
                  "start": 161,
                  "end": 173
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 175,
                  "end": 180
                }
              }
            }
          },
          "span": {
            "start": 161,
            "end": 180
          }
        }
      },
      "span": {
        "start": 161,
        "end": 181
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "MT_RAND_PHP"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 183,
                          "end": 194
                        }
                      }
                    },
                    "span": {
                      "start": 183,
                      "end": 194
                    }
                  }
                },
                "span": {
                  "start": 182,
                  "end": 195
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 197,
                  "end": 202
                }
              }
            }
          },
          "span": {
            "start": 182,
            "end": 202
          }
        }
      },
      "span": {
        "start": 182,
        "end": 203
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "E_STRICT"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 205,
                          "end": 213
                        }
                      }
                    },
                    "span": {
                      "start": 205,
                      "end": 213
                    }
                  }
                },
                "span": {
                  "start": 204,
                  "end": 214
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 216,
                  "end": 221
                }
              }
            }
          },
          "span": {
            "start": 204,
            "end": 221
          }
        }
      },
      "span": {
        "start": 204,
        "end": 222
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "SORT_LOCALE_STRING"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 224,
                          "end": 242
                        }
                      }
                    },
                    "span": {
                      "start": 224,
                      "end": 242
                    }
                  }
                },
                "span": {
                  "start": 223,
                  "end": 243
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 245,
                  "end": 250
                }
              }
            }
          },
          "span": {
            "start": 223,
            "end": 250
          }
        }
      },
      "span": {
        "start": 223,
        "end": 251
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "LC_ALL"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 253,
                          "end": 259
                        }
                      }
                    },
                    "span": {
                      "start": 253,
                      "end": 259
                    }
                  }
                },
                "span": {
                  "start": 252,
                  "end": 260
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 262,
                  "end": 267
                }
              }
            }
          },
          "span": {
            "start": 252,
            "end": 267
          }
        }
      },
      "span": {
        "start": 252,
        "end": 268
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 268
  }
}

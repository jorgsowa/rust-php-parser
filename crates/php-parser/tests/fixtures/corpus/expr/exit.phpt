===source===
<?php
exit;
exit();
exit('Die!');
die;
die();
die('Exit!');

exit(status: 42);
exit(...$args);
exit($a, $b);
\exit($a);
exit(...);
DIE($a, $b);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
===errors 8.0===
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
===errors 8.1-8.3===
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
'exit function call' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 9
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token ":", expecting ")" in Standard input code on line 9
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 12,
            "end": 18
          }
        }
      },
      "span": {
        "start": 12,
        "end": 19
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "String": "Die!"
              },
              "span": {
                "start": 25,
                "end": 31
              }
            }
          },
          "span": {
            "start": 20,
            "end": 32
          }
        }
      },
      "span": {
        "start": 20,
        "end": 33
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 34,
            "end": 37
          }
        }
      },
      "span": {
        "start": 34,
        "end": 38
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": null
          },
          "span": {
            "start": 39,
            "end": 44
          }
        }
      },
      "span": {
        "start": 39,
        "end": 45
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "String": "Exit!"
              },
              "span": {
                "start": 50,
                "end": 57
              }
            }
          },
          "span": {
            "start": 46,
            "end": 58
          }
        }
      },
      "span": {
        "start": 46,
        "end": 59
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
                      "exit"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 61,
                      "end": 65
                    }
                  }
                },
                "span": {
                  "start": 61,
                  "end": 65
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "status"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 66,
                      "end": 72
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 42
                      },
                      "span": {
                        "start": 74,
                        "end": 76
                      }
                    }
                  },
                  "span": {
                    "start": 66,
                    "end": 76
                  }
                }
              ]
            }
          },
          "span": {
            "start": 61,
            "end": 77
          }
        }
      },
      "span": {
        "start": 61,
        "end": 78
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
                      "exit"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 79,
                      "end": 83
                    }
                  }
                },
                "span": {
                  "start": 79,
                  "end": 83
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "args"
                      },
                      "span": {
                        "start": 87,
                        "end": 92
                      }
                    }
                  },
                  "span": {
                    "start": 84,
                    "end": 92
                  }
                }
              ]
            }
          },
          "span": {
            "start": 79,
            "end": 93
          }
        }
      },
      "span": {
        "start": 79,
        "end": 94
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
                      "exit"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 95,
                      "end": 99
                    }
                  }
                },
                "span": {
                  "start": 95,
                  "end": 99
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
                        "start": 100,
                        "end": 102
                      }
                    }
                  },
                  "span": {
                    "start": 100,
                    "end": 102
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
                        "start": 104,
                        "end": 106
                      }
                    }
                  },
                  "span": {
                    "start": 104,
                    "end": 106
                  }
                }
              ]
            }
          },
          "span": {
            "start": 95,
            "end": 107
          }
        }
      },
      "span": {
        "start": 95,
        "end": 108
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
                      "exit"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 109,
                      "end": 114
                    }
                  }
                },
                "span": {
                  "start": 109,
                  "end": 114
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
                        "start": 115,
                        "end": 117
                      }
                    }
                  },
                  "span": {
                    "start": 115,
                    "end": 117
                  }
                }
              ]
            }
          },
          "span": {
            "start": 109,
            "end": 118
          }
        }
      },
      "span": {
        "start": 109,
        "end": 119
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Function": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "exit"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 120,
                        "end": 124
                      }
                    }
                  },
                  "span": {
                    "start": 120,
                    "end": 124
                  }
                }
              }
            }
          },
          "span": {
            "start": 120,
            "end": 129
          }
        }
      },
      "span": {
        "start": 120,
        "end": 130
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
                      "DIE"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 131,
                      "end": 134
                    }
                  }
                },
                "span": {
                  "start": 131,
                  "end": 134
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
                        "start": 135,
                        "end": 137
                      }
                    }
                  },
                  "span": {
                    "start": 135,
                    "end": 137
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
                        "start": 139,
                        "end": 141
                      }
                    }
                  },
                  "span": {
                    "start": 139,
                    "end": 141
                  }
                }
              ]
            }
          },
          "span": {
            "start": 131,
            "end": 142
          }
        }
      },
      "span": {
        "start": 131,
        "end": 143
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 143
  }
}

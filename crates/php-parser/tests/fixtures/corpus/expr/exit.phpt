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
            "end": 10,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12,
        "start_line": 2,
        "start_col": 0
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
            "end": 18,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 12,
        "end": 20,
        "start_line": 3,
        "start_col": 0
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
                "end": 31,
                "start_line": 4,
                "start_col": 5
              }
            }
          },
          "span": {
            "start": 20,
            "end": 32,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 20,
        "end": 34,
        "start_line": 4,
        "start_col": 0
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
            "end": 37,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 34,
        "end": 39,
        "start_line": 5,
        "start_col": 0
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
            "end": 44,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 39,
        "end": 46,
        "start_line": 6,
        "start_col": 0
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
                "end": 57,
                "start_line": 7,
                "start_col": 4
              }
            }
          },
          "span": {
            "start": 46,
            "end": 58,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 46,
        "end": 61,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "exit"
                },
                "span": {
                  "start": 61,
                  "end": 65,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "status",
                  "value": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 74,
                      "end": 76,
                      "start_line": 9,
                      "start_col": 13
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 66,
                    "end": 76,
                    "start_line": 9,
                    "start_col": 5
                  }
                }
              ]
            }
          },
          "span": {
            "start": 61,
            "end": 77,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 61,
        "end": 79,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "exit"
                },
                "span": {
                  "start": 79,
                  "end": 83,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "args"
                    },
                    "span": {
                      "start": 87,
                      "end": 92,
                      "start_line": 10,
                      "start_col": 8
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 84,
                    "end": 92,
                    "start_line": 10,
                    "start_col": 5
                  }
                }
              ]
            }
          },
          "span": {
            "start": 79,
            "end": 93,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 79,
        "end": 95,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "exit"
                },
                "span": {
                  "start": 95,
                  "end": 99,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 100,
                      "end": 102,
                      "start_line": 11,
                      "start_col": 5
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 100,
                    "end": 102,
                    "start_line": 11,
                    "start_col": 5
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 104,
                      "end": 106,
                      "start_line": 11,
                      "start_col": 9
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 104,
                    "end": 106,
                    "start_line": 11,
                    "start_col": 9
                  }
                }
              ]
            }
          },
          "span": {
            "start": 95,
            "end": 107,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 95,
        "end": 109,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "\\exit"
                },
                "span": {
                  "start": 109,
                  "end": 114,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 115,
                      "end": 117,
                      "start_line": 12,
                      "start_col": 6
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 115,
                    "end": 117,
                    "start_line": 12,
                    "start_col": 6
                  }
                }
              ]
            }
          },
          "span": {
            "start": 109,
            "end": 118,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 109,
        "end": 120,
        "start_line": 12,
        "start_col": 0
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
                    "Identifier": "exit"
                  },
                  "span": {
                    "start": 120,
                    "end": 124,
                    "start_line": 13,
                    "start_col": 0
                  }
                }
              }
            }
          },
          "span": {
            "start": 120,
            "end": 129,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 120,
        "end": 131,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "DIE"
                },
                "span": {
                  "start": 131,
                  "end": 134,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 135,
                      "end": 137,
                      "start_line": 14,
                      "start_col": 4
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 135,
                    "end": 137,
                    "start_line": 14,
                    "start_col": 4
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 139,
                      "end": 141,
                      "start_line": 14,
                      "start_col": 8
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 139,
                    "end": 141,
                    "start_line": 14,
                    "start_col": 8
                  }
                }
              ]
            }
          },
          "span": {
            "start": 131,
            "end": 142,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 131,
        "end": 143,
        "start_line": 14,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 143,
    "start_line": 1,
    "start_col": 0
  }
}

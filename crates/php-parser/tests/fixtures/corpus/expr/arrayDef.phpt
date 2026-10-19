===source===
<?php

array();
array('a');
array('a', );
array('a', 'b');
array('a', &$b, 'c' => 'd', 'e' => &$f);

// short array syntax
[];
[1, 2, 3];
['a' => 'b'];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": []
          },
          "span": {
            "start": 7,
            "end": 14
          }
        }
      },
      "span": {
        "start": 7,
        "end": 15
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 22,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 25
                }
              }
            ]
          },
          "span": {
            "start": 16,
            "end": 26
          }
        }
      },
      "span": {
        "start": 16,
        "end": 27
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 34,
                      "end": 37
                    }
                  }
                },
                "span": {
                  "start": 34,
                  "end": 37
                }
              }
            ]
          },
          "span": {
            "start": 28,
            "end": 40
          }
        }
      },
      "span": {
        "start": 28,
        "end": 41
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 48,
                      "end": 51
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 51
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 53,
                      "end": 56
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 56
                }
              }
            ]
          },
          "span": {
            "start": 42,
            "end": 57
          }
        }
      },
      "span": {
        "start": 42,
        "end": 58
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 65,
                      "end": 68
                    }
                  }
                },
                "span": {
                  "start": 65,
                  "end": 68
                }
              },
              {
                "key": null,
                "kind": {
                  "ByRef": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 71,
                      "end": 73
                    }
                  }
                },
                "span": {
                  "start": 70,
                  "end": 73
                }
              },
              {
                "key": {
                  "kind": {
                    "String": "c"
                  },
                  "span": {
                    "start": 75,
                    "end": 78
                  }
                },
                "kind": {
                  "Value": {
                    "kind": {
                      "String": "d"
                    },
                    "span": {
                      "start": 82,
                      "end": 85
                    }
                  }
                },
                "span": {
                  "start": 75,
                  "end": 85
                }
              },
              {
                "key": {
                  "kind": {
                    "String": "e"
                  },
                  "span": {
                    "start": 87,
                    "end": 90
                  }
                },
                "kind": {
                  "ByRef": {
                    "kind": {
                      "Variable": "f"
                    },
                    "span": {
                      "start": 95,
                      "end": 97
                    }
                  }
                },
                "span": {
                  "start": 87,
                  "end": 97
                }
              }
            ]
          },
          "span": {
            "start": 59,
            "end": 98
          }
        }
      },
      "span": {
        "start": 59,
        "end": 99
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": []
          },
          "span": {
            "start": 123,
            "end": 125
          }
        }
      },
      "span": {
        "start": 123,
        "end": 126
      }
    },
    {
      "kind": {
        "Expression": {
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
                      "start": 128,
                      "end": 129
                    }
                  }
                },
                "span": {
                  "start": 128,
                  "end": 129
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 131,
                      "end": 132
                    }
                  }
                },
                "span": {
                  "start": 131,
                  "end": 132
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 134,
                      "end": 135
                    }
                  }
                },
                "span": {
                  "start": 134,
                  "end": 135
                }
              }
            ]
          },
          "span": {
            "start": 127,
            "end": 136
          }
        }
      },
      "span": {
        "start": 127,
        "end": 137
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 139,
                    "end": 142
                  }
                },
                "kind": {
                  "Value": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 146,
                      "end": 149
                    }
                  }
                },
                "span": {
                  "start": 139,
                  "end": 149
                }
              }
            ]
          },
          "span": {
            "start": 138,
            "end": 150
          }
        }
      },
      "span": {
        "start": 138,
        "end": 151
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 151
  }
}

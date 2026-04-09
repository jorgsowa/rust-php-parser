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
            "end": 14,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 16,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 22,
                    "end": 25,
                    "start_line": 4,
                    "start_col": 6
                  }
                },
                "unpack": false,
                "span": {
                  "start": 22,
                  "end": 25,
                  "start_line": 4,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 16,
            "end": 26,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 16,
        "end": 28,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 34,
                    "end": 37,
                    "start_line": 5,
                    "start_col": 6
                  }
                },
                "unpack": false,
                "span": {
                  "start": 34,
                  "end": 37,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 28,
            "end": 40,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 28,
        "end": 42,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 48,
                    "end": 51,
                    "start_line": 6,
                    "start_col": 6
                  }
                },
                "unpack": false,
                "span": {
                  "start": 48,
                  "end": 51,
                  "start_line": 6,
                  "start_col": 6
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "String": "b"
                  },
                  "span": {
                    "start": 53,
                    "end": 56,
                    "start_line": 6,
                    "start_col": 11
                  }
                },
                "unpack": false,
                "span": {
                  "start": 53,
                  "end": 56,
                  "start_line": 6,
                  "start_col": 11
                }
              }
            ]
          },
          "span": {
            "start": 42,
            "end": 57,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 42,
        "end": 59,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 65,
                    "end": 68,
                    "start_line": 7,
                    "start_col": 6
                  }
                },
                "unpack": false,
                "span": {
                  "start": 65,
                  "end": 68,
                  "start_line": 7,
                  "start_col": 6
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Variable": "b"
                  },
                  "span": {
                    "start": 71,
                    "end": 73,
                    "start_line": 7,
                    "start_col": 12
                  }
                },
                "unpack": false,
                "by_ref": true,
                "span": {
                  "start": 70,
                  "end": 73,
                  "start_line": 7,
                  "start_col": 11
                }
              },
              {
                "key": {
                  "kind": {
                    "String": "c"
                  },
                  "span": {
                    "start": 75,
                    "end": 78,
                    "start_line": 7,
                    "start_col": 16
                  }
                },
                "value": {
                  "kind": {
                    "String": "d"
                  },
                  "span": {
                    "start": 82,
                    "end": 85,
                    "start_line": 7,
                    "start_col": 23
                  }
                },
                "unpack": false,
                "span": {
                  "start": 75,
                  "end": 85,
                  "start_line": 7,
                  "start_col": 16
                }
              },
              {
                "key": {
                  "kind": {
                    "String": "e"
                  },
                  "span": {
                    "start": 87,
                    "end": 90,
                    "start_line": 7,
                    "start_col": 28
                  }
                },
                "value": {
                  "kind": {
                    "Variable": "f"
                  },
                  "span": {
                    "start": 95,
                    "end": 97,
                    "start_line": 7,
                    "start_col": 36
                  }
                },
                "unpack": false,
                "by_ref": true,
                "span": {
                  "start": 87,
                  "end": 97,
                  "start_line": 7,
                  "start_col": 28
                }
              }
            ]
          },
          "span": {
            "start": 59,
            "end": 98,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 59,
        "end": 123,
        "start_line": 7,
        "start_col": 0
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
            "end": 125,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 123,
        "end": 127,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 128,
                    "end": 129,
                    "start_line": 11,
                    "start_col": 1
                  }
                },
                "unpack": false,
                "span": {
                  "start": 128,
                  "end": 129,
                  "start_line": 11,
                  "start_col": 1
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 2
                  },
                  "span": {
                    "start": 131,
                    "end": 132,
                    "start_line": 11,
                    "start_col": 4
                  }
                },
                "unpack": false,
                "span": {
                  "start": 131,
                  "end": 132,
                  "start_line": 11,
                  "start_col": 4
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 3
                  },
                  "span": {
                    "start": 134,
                    "end": 135,
                    "start_line": 11,
                    "start_col": 7
                  }
                },
                "unpack": false,
                "span": {
                  "start": 134,
                  "end": 135,
                  "start_line": 11,
                  "start_col": 7
                }
              }
            ]
          },
          "span": {
            "start": 127,
            "end": 136,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 127,
        "end": 138,
        "start_line": 11,
        "start_col": 0
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
                    "end": 142,
                    "start_line": 12,
                    "start_col": 1
                  }
                },
                "value": {
                  "kind": {
                    "String": "b"
                  },
                  "span": {
                    "start": 146,
                    "end": 149,
                    "start_line": 12,
                    "start_col": 8
                  }
                },
                "unpack": false,
                "span": {
                  "start": 139,
                  "end": 149,
                  "start_line": 12,
                  "start_col": 1
                }
              }
            ]
          },
          "span": {
            "start": 138,
            "end": 150,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 138,
        "end": 151,
        "start_line": 12,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 151,
    "start_line": 1,
    "start_col": 0
  }
}

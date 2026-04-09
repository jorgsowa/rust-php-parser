===source===
<?php

// foreach on variable
foreach ($a as $b)  {}
foreach ($a as &$b) {}
foreach ($a as $b => $c) {}
foreach ($a as $b => &$c) {}
foreach ($a as list($a, $b)) {}
foreach ($a as $a => list($b, , $c)) {}

// foreach on expression
foreach (array() as $b) {}

// alternative syntax
foreach ($a as $b):
endforeach;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 39,
              "end": 41,
              "start_line": 4,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 45,
              "end": 47,
              "start_line": 4,
              "start_col": 15
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 50,
              "end": 52,
              "start_line": 4,
              "start_col": 20
            }
          }
        }
      },
      "span": {
        "start": 30,
        "end": 52,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 62,
              "end": 64,
              "start_line": 5,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 69,
              "end": 71,
              "start_line": 5,
              "start_col": 16
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 73,
              "end": 75,
              "start_line": 5,
              "start_col": 20
            }
          }
        }
      },
      "span": {
        "start": 53,
        "end": 75,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 85,
              "end": 87,
              "start_line": 6,
              "start_col": 9
            }
          },
          "key": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 91,
              "end": 93,
              "start_line": 6,
              "start_col": 15
            }
          },
          "value": {
            "kind": {
              "Variable": "c"
            },
            "span": {
              "start": 97,
              "end": 99,
              "start_line": 6,
              "start_col": 21
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 101,
              "end": 103,
              "start_line": 6,
              "start_col": 25
            }
          }
        }
      },
      "span": {
        "start": 76,
        "end": 103,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 113,
              "end": 115,
              "start_line": 7,
              "start_col": 9
            }
          },
          "key": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 119,
              "end": 121,
              "start_line": 7,
              "start_col": 15
            }
          },
          "value": {
            "kind": {
              "Variable": "c"
            },
            "span": {
              "start": 126,
              "end": 128,
              "start_line": 7,
              "start_col": 22
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 130,
              "end": 132,
              "start_line": 7,
              "start_col": 26
            }
          }
        }
      },
      "span": {
        "start": 104,
        "end": 132,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 142,
              "end": 144,
              "start_line": 8,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 153,
                      "end": 155,
                      "start_line": 8,
                      "start_col": 20
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 153,
                    "end": 155,
                    "start_line": 8,
                    "start_col": 20
                  }
                },
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 157,
                      "end": 159,
                      "start_line": 8,
                      "start_col": 24
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 157,
                    "end": 159,
                    "start_line": 8,
                    "start_col": 24
                  }
                }
              ]
            },
            "span": {
              "start": 148,
              "end": 160,
              "start_line": 8,
              "start_col": 15
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 162,
              "end": 164,
              "start_line": 8,
              "start_col": 29
            }
          }
        }
      },
      "span": {
        "start": 133,
        "end": 164,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 174,
              "end": 176,
              "start_line": 9,
              "start_col": 9
            }
          },
          "key": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 180,
              "end": 182,
              "start_line": 9,
              "start_col": 15
            }
          },
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 191,
                      "end": 193,
                      "start_line": 9,
                      "start_col": 26
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 191,
                    "end": 193,
                    "start_line": 9,
                    "start_col": 26
                  }
                },
                {
                  "key": null,
                  "value": {
                    "kind": "Omit",
                    "span": {
                      "start": 195,
                      "end": 196,
                      "start_line": 9,
                      "start_col": 30
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 195,
                    "end": 196,
                    "start_line": 9,
                    "start_col": 30
                  }
                },
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 197,
                      "end": 199,
                      "start_line": 9,
                      "start_col": 32
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 197,
                    "end": 199,
                    "start_line": 9,
                    "start_col": 32
                  }
                }
              ]
            },
            "span": {
              "start": 186,
              "end": 200,
              "start_line": 9,
              "start_col": 21
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 202,
              "end": 204,
              "start_line": 9,
              "start_col": 37
            }
          }
        }
      },
      "span": {
        "start": 165,
        "end": 204,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Array": []
            },
            "span": {
              "start": 240,
              "end": 247,
              "start_line": 12,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 251,
              "end": 253,
              "start_line": 12,
              "start_col": 20
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 255,
              "end": 257,
              "start_line": 12,
              "start_col": 24
            }
          }
        }
      },
      "span": {
        "start": 231,
        "end": 257,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 290,
              "end": 292,
              "start_line": 15,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 296,
              "end": 298,
              "start_line": 15,
              "start_col": 15
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 281,
              "end": 312,
              "start_line": 15,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 281,
        "end": 312,
        "start_line": 15,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 312,
    "start_line": 1,
    "start_col": 0
  }
}

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
              "end": 41
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 45,
              "end": 47
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 50,
              "end": 52
            }
          }
        }
      },
      "span": {
        "start": 30,
        "end": 52
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
              "end": 64
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 69,
              "end": 71
            }
          },
          "by_ref": true,
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 73,
              "end": 75
            }
          }
        }
      },
      "span": {
        "start": 53,
        "end": 75
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
              "end": 87
            }
          },
          "key": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 91,
              "end": 93
            }
          },
          "value": {
            "kind": {
              "Variable": "c"
            },
            "span": {
              "start": 97,
              "end": 99
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 101,
              "end": 103
            }
          }
        }
      },
      "span": {
        "start": 76,
        "end": 103
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
              "end": 115
            }
          },
          "key": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 119,
              "end": 121
            }
          },
          "value": {
            "kind": {
              "Variable": "c"
            },
            "span": {
              "start": 126,
              "end": 128
            }
          },
          "by_ref": true,
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 130,
              "end": 132
            }
          }
        }
      },
      "span": {
        "start": 104,
        "end": 132
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
              "end": 144
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 153,
                        "end": 155
                      }
                    }
                  },
                  "span": {
                    "start": 153,
                    "end": 155
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 157,
                        "end": 159
                      }
                    }
                  },
                  "span": {
                    "start": 157,
                    "end": 159
                  }
                }
              ]
            },
            "span": {
              "start": 148,
              "end": 160
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 162,
              "end": 164
            }
          }
        }
      },
      "span": {
        "start": 133,
        "end": 164
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
              "end": 176
            }
          },
          "key": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 180,
              "end": 182
            }
          },
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 191,
                        "end": 193
                      }
                    }
                  },
                  "span": {
                    "start": 191,
                    "end": 193
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": "Omit",
                      "span": {
                        "start": 195,
                        "end": 196
                      }
                    }
                  },
                  "span": {
                    "start": 195,
                    "end": 196
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 197,
                        "end": 199
                      }
                    }
                  },
                  "span": {
                    "start": 197,
                    "end": 199
                  }
                }
              ]
            },
            "span": {
              "start": 186,
              "end": 200
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 202,
              "end": 204
            }
          }
        }
      },
      "span": {
        "start": 165,
        "end": 204
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
              "end": 247
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 251,
              "end": 253
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 255,
              "end": 257
            }
          }
        }
      },
      "span": {
        "start": 231,
        "end": 257
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
              "end": 292
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 296,
              "end": 298
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 299,
              "end": 300
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 281,
        "end": 312
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 312
  }
}

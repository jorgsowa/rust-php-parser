===source===
<?php
goto w;
while (true) {
    w:
}
do {
    d:
} while (false);
goto d;
for (;;) {
    f:
}
goto f;
foreach ([] as $v) {
    e:
}
goto e;
switch (1) {
    case 1:
        s:
}
goto s;
while (true) {
    while (true) {
        n:
    }
    goto n;
}
===errors===
'goto' into loop or switch statement is disallowed
'goto' into loop or switch statement is disallowed
'goto' into loop or switch statement is disallowed
'goto' into loop or switch statement is disallowed
'goto' into loop or switch statement is disallowed
'goto' into loop or switch statement is disallowed
===php_error===
PHP Fatal error:  'goto' into loop or switch statement is disallowed in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Goto": {
          "name": "w",
          "span": {
            "start": 11,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 21,
              "end": 25
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Label": {
                      "name": "w",
                      "span": {
                        "start": 33,
                        "end": 34
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 35
                  }
                }
              ]
            },
            "span": {
              "start": 27,
              "end": 37
            }
          }
        }
      },
      "span": {
        "start": 14,
        "end": 37
      }
    },
    {
      "kind": {
        "DoWhile": {
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Label": {
                      "name": "d",
                      "span": {
                        "start": 47,
                        "end": 48
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 49
                  }
                }
              ]
            },
            "span": {
              "start": 41,
              "end": 51
            }
          },
          "condition": {
            "kind": {
              "Bool": false
            },
            "span": {
              "start": 59,
              "end": 64
            }
          }
        }
      },
      "span": {
        "start": 38,
        "end": 66
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "d",
          "span": {
            "start": 72,
            "end": 73
          }
        }
      },
      "span": {
        "start": 67,
        "end": 74
      }
    },
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [],
          "update": [],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Label": {
                      "name": "f",
                      "span": {
                        "start": 90,
                        "end": 91
                      }
                    }
                  },
                  "span": {
                    "start": 90,
                    "end": 92
                  }
                }
              ]
            },
            "span": {
              "start": 84,
              "end": 94
            }
          }
        }
      },
      "span": {
        "start": 75,
        "end": 94
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "f",
          "span": {
            "start": 100,
            "end": 101
          }
        }
      },
      "span": {
        "start": 95,
        "end": 102
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
              "start": 112,
              "end": 114
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 118,
              "end": 120
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Label": {
                      "name": "e",
                      "span": {
                        "start": 128,
                        "end": 129
                      }
                    }
                  },
                  "span": {
                    "start": 128,
                    "end": 130
                  }
                }
              ]
            },
            "span": {
              "start": 122,
              "end": 132
            }
          }
        }
      },
      "span": {
        "start": 103,
        "end": 132
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "e",
          "span": {
            "start": 138,
            "end": 139
          }
        }
      },
      "span": {
        "start": 133,
        "end": 140
      }
    },
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 149,
              "end": 150
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 163,
                  "end": 164
                }
              },
              "body": [
                {
                  "kind": {
                    "Label": {
                      "name": "s",
                      "span": {
                        "start": 174,
                        "end": 175
                      }
                    }
                  },
                  "span": {
                    "start": 174,
                    "end": 176
                  }
                }
              ],
              "span": {
                "start": 158,
                "end": 176
              }
            }
          ]
        }
      },
      "span": {
        "start": 141,
        "end": 178
      }
    },
    {
      "kind": {
        "Goto": {
          "name": "s",
          "span": {
            "start": 184,
            "end": 185
          }
        }
      },
      "span": {
        "start": 179,
        "end": 186
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 194,
              "end": 198
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "While": {
                      "condition": {
                        "kind": {
                          "Bool": true
                        },
                        "span": {
                          "start": 213,
                          "end": 217
                        }
                      },
                      "body": {
                        "kind": {
                          "Block": [
                            {
                              "kind": {
                                "Label": {
                                  "name": "n",
                                  "span": {
                                    "start": 229,
                                    "end": 230
                                  }
                                }
                              },
                              "span": {
                                "start": 229,
                                "end": 231
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 219,
                          "end": 237
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 206,
                    "end": 237
                  }
                },
                {
                  "kind": {
                    "Goto": {
                      "name": "n",
                      "span": {
                        "start": 247,
                        "end": 248
                      }
                    }
                  },
                  "span": {
                    "start": 242,
                    "end": 249
                  }
                }
              ]
            },
            "span": {
              "start": 200,
              "end": 251
            }
          }
        }
      },
      "span": {
        "start": 187,
        "end": 251
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 251
  }
}

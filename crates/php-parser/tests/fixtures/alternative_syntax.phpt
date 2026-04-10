===source===
<?php
if ($x > 0):
    echo 'positive';
elseif ($x < 0):
    echo 'negative';
else:
    echo 'zero';
endif;
while ($i < 5):
    echo $i;
    $i++;
endwhile;
for ($i = 0; $i < 3; $i++):
    echo $i;
endfor;
foreach ($items as $item):
    echo $item;
endforeach;
switch ($color):
    case 'red':
        echo 'red';
        break;
    default:
        echo 'other';
endswitch;
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 10,
                    "end": 12
                  }
                },
                "op": "Greater",
                "right": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 15,
                    "end": 16
                  }
                }
              }
            },
            "span": {
              "start": 10,
              "end": 16
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "positive"
                        },
                        "span": {
                          "start": 28,
                          "end": 38
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 23,
                    "end": 39
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 39
            }
          },
          "elseif_branches": [
            {
              "condition": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 48,
                        "end": 50
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 53,
                        "end": 54
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 54
                }
              },
              "body": {
                "kind": {
                  "Block": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "negative"
                            },
                            "span": {
                              "start": 66,
                              "end": 76
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 61,
                        "end": 77
                      }
                    }
                  ]
                },
                "span": {
                  "start": 47,
                  "end": 77
                }
              },
              "span": {
                "start": 47,
                "end": 77
              }
            }
          ],
          "else_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "zero"
                        },
                        "span": {
                          "start": 93,
                          "end": 99
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 88,
                    "end": 100
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 100
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 107
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "i"
                  },
                  "span": {
                    "start": 115,
                    "end": 117
                  }
                },
                "op": "Less",
                "right": {
                  "kind": {
                    "Int": 5
                  },
                  "span": {
                    "start": 120,
                    "end": 121
                  }
                }
              }
            },
            "span": {
              "start": 115,
              "end": 121
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "i"
                        },
                        "span": {
                          "start": 133,
                          "end": 135
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 128,
                    "end": 136
                  }
                },
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "UnaryPostfix": {
                          "operand": {
                            "kind": {
                              "Variable": "i"
                            },
                            "span": {
                              "start": 141,
                              "end": 143
                            }
                          },
                          "op": "PostIncrement"
                        }
                      },
                      "span": {
                        "start": 141,
                        "end": 145
                      }
                    }
                  },
                  "span": {
                    "start": 141,
                    "end": 146
                  }
                }
              ]
            },
            "span": {
              "start": 108,
              "end": 156
            }
          }
        }
      },
      "span": {
        "start": 108,
        "end": 156
      }
    },
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 162,
                      "end": 164
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 167,
                      "end": 168
                    }
                  }
                }
              },
              "span": {
                "start": 162,
                "end": 168
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 170,
                      "end": 172
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 175,
                      "end": 176
                    }
                  }
                }
              },
              "span": {
                "start": 170,
                "end": 176
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 178,
                      "end": 180
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 178,
                "end": 182
              }
            }
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "i"
                        },
                        "span": {
                          "start": 194,
                          "end": 196
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 189,
                    "end": 197
                  }
                }
              ]
            },
            "span": {
              "start": 157,
              "end": 205
            }
          }
        }
      },
      "span": {
        "start": 157,
        "end": 205
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "items"
            },
            "span": {
              "start": 215,
              "end": 221
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "item"
            },
            "span": {
              "start": 225,
              "end": 230
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "item"
                        },
                        "span": {
                          "start": 242,
                          "end": 247
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 237,
                    "end": 248
                  }
                }
              ]
            },
            "span": {
              "start": 206,
              "end": 260
            }
          }
        }
      },
      "span": {
        "start": 206,
        "end": 260
      }
    },
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "color"
            },
            "span": {
              "start": 269,
              "end": 275
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "String": "red"
                },
                "span": {
                  "start": 287,
                  "end": 292
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "red"
                        },
                        "span": {
                          "start": 307,
                          "end": 312
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 302,
                    "end": 313
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 322,
                    "end": 328
                  }
                }
              ],
              "span": {
                "start": 282,
                "end": 328
              }
            },
            {
              "value": null,
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "other"
                        },
                        "span": {
                          "start": 355,
                          "end": 362
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 350,
                    "end": 363
                  }
                }
              ],
              "span": {
                "start": 333,
                "end": 363
              }
            }
          ]
        }
      },
      "span": {
        "start": 261,
        "end": 374
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 374
  }
}

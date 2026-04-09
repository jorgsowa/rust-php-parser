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
                    "end": 12,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                "op": "Greater",
                "right": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 15,
                    "end": 16,
                    "start_line": 2,
                    "start_col": 9
                  }
                }
              }
            },
            "span": {
              "start": 10,
              "end": 16,
              "start_line": 2,
              "start_col": 4
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
                          "end": 38,
                          "start_line": 3,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 23,
                    "end": 40,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 40,
              "start_line": 2,
              "start_col": 0
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
                        "end": 50,
                        "start_line": 4,
                        "start_col": 8
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 53,
                        "end": 54,
                        "start_line": 4,
                        "start_col": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 54,
                  "start_line": 4,
                  "start_col": 8
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
                              "end": 76,
                              "start_line": 5,
                              "start_col": 9
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 61,
                        "end": 78,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  ]
                },
                "span": {
                  "start": 47,
                  "end": 78,
                  "start_line": 4,
                  "start_col": 7
                }
              },
              "span": {
                "start": 47,
                "end": 78,
                "start_line": 4,
                "start_col": 7
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
                          "end": 99,
                          "start_line": 7,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 88,
                    "end": 101,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 101,
              "start_line": 2,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 108,
        "start_line": 2,
        "start_col": 0
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
                    "end": 117,
                    "start_line": 9,
                    "start_col": 7
                  }
                },
                "op": "Less",
                "right": {
                  "kind": {
                    "Int": 5
                  },
                  "span": {
                    "start": 120,
                    "end": 121,
                    "start_line": 9,
                    "start_col": 12
                  }
                }
              }
            },
            "span": {
              "start": 115,
              "end": 121,
              "start_line": 9,
              "start_col": 7
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
                          "end": 135,
                          "start_line": 10,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 128,
                    "end": 141,
                    "start_line": 10,
                    "start_col": 4
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
                              "end": 143,
                              "start_line": 11,
                              "start_col": 4
                            }
                          },
                          "op": "PostIncrement"
                        }
                      },
                      "span": {
                        "start": 141,
                        "end": 145,
                        "start_line": 11,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 141,
                    "end": 147,
                    "start_line": 11,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 108,
              "end": 157,
              "start_line": 9,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 108,
        "end": 157,
        "start_line": 9,
        "start_col": 0
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
                      "end": 164,
                      "start_line": 13,
                      "start_col": 5
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 167,
                      "end": 168,
                      "start_line": 13,
                      "start_col": 10
                    }
                  }
                }
              },
              "span": {
                "start": 162,
                "end": 168,
                "start_line": 13,
                "start_col": 5
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
                      "end": 172,
                      "start_line": 13,
                      "start_col": 13
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 175,
                      "end": 176,
                      "start_line": 13,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 170,
                "end": 176,
                "start_line": 13,
                "start_col": 13
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
                      "end": 180,
                      "start_line": 13,
                      "start_col": 21
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 178,
                "end": 182,
                "start_line": 13,
                "start_col": 21
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
                          "end": 196,
                          "start_line": 14,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 189,
                    "end": 198,
                    "start_line": 14,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 157,
              "end": 206,
              "start_line": 13,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 157,
        "end": 206,
        "start_line": 13,
        "start_col": 0
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
              "end": 221,
              "start_line": 16,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "item"
            },
            "span": {
              "start": 225,
              "end": 230,
              "start_line": 16,
              "start_col": 19
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
                          "end": 247,
                          "start_line": 17,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 237,
                    "end": 249,
                    "start_line": 17,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 206,
              "end": 261,
              "start_line": 16,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 206,
        "end": 261,
        "start_line": 16,
        "start_col": 0
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
              "end": 275,
              "start_line": 19,
              "start_col": 8
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
                  "end": 292,
                  "start_line": 20,
                  "start_col": 9
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
                          "end": 312,
                          "start_line": 21,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 302,
                    "end": 322,
                    "start_line": 21,
                    "start_col": 8
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 322,
                    "end": 333,
                    "start_line": 22,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 282,
                "end": 333,
                "start_line": 20,
                "start_col": 4
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
                          "end": 362,
                          "start_line": 24,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 350,
                    "end": 364,
                    "start_line": 24,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 333,
                "end": 364,
                "start_line": 23,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 261,
        "end": 374,
        "start_line": 19,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 374,
    "start_line": 1,
    "start_col": 0
  }
}

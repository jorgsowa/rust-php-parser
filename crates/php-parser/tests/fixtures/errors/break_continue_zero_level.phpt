===source===
<?php
for ($i = 0; $i < 10; $i++) {
    break 0;
}
for ($i = 0; $i < 10; $i++) {
    continue 0;
}
===errors===
'break' operator accepts only positive integers
'continue' operator accepts only positive integers
===ast===
{
  "stmts": [
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
                      "start": 11,
                      "end": 13
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 17
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
                      "start": 19,
                      "end": 21
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 24,
                      "end": 26
                    }
                  }
                }
              },
              "span": {
                "start": 19,
                "end": 26
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
                      "start": 28,
                      "end": 30
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 28,
                "end": 32
              }
            }
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Break": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 46,
                        "end": 47
                      }
                    }
                  },
                  "span": {
                    "start": 40,
                    "end": 48
                  }
                }
              ]
            },
            "span": {
              "start": 34,
              "end": 50
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 50
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
                      "start": 56,
                      "end": 58
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 61,
                      "end": 62
                    }
                  }
                }
              },
              "span": {
                "start": 56,
                "end": 62
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
                      "start": 64,
                      "end": 66
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 69,
                      "end": 71
                    }
                  }
                }
              },
              "span": {
                "start": 64,
                "end": 71
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
                      "start": 73,
                      "end": 75
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 73,
                "end": 77
              }
            }
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Continue": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 94,
                        "end": 95
                      }
                    }
                  },
                  "span": {
                    "start": 85,
                    "end": 96
                  }
                }
              ]
            },
            "span": {
              "start": 79,
              "end": 98
            }
          }
        }
      },
      "span": {
        "start": 51,
        "end": 98
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 98
  }
}
===php_error===
PHP Fatal error:  'break' operator accepts only positive integers in Standard input code on line 3

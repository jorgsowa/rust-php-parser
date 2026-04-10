===source===
<?php
if ($a):
    echo 1;
endif;
while ($b):
    echo 2;
endwhile;
for ($i = 0; $i < 10; $i++):
    echo 3;
endfor;
foreach ($arr as $v):
    echo 4;
endforeach;
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 10,
              "end": 12
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
                          "Int": 1
                        },
                        "span": {
                          "start": 24,
                          "end": 25
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 19,
                    "end": 26
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 26
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 41,
              "end": 43
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
                          "Int": 2
                        },
                        "span": {
                          "start": 55,
                          "end": 56
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 50,
                    "end": 57
                  }
                }
              ]
            },
            "span": {
              "start": 34,
              "end": 67
            }
          }
        }
      },
      "span": {
        "start": 34,
        "end": 67
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
                      "start": 73,
                      "end": 75
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 78,
                      "end": 79
                    }
                  }
                }
              },
              "span": {
                "start": 73,
                "end": 79
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
                      "start": 81,
                      "end": 83
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 86,
                      "end": 88
                    }
                  }
                }
              },
              "span": {
                "start": 81,
                "end": 88
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
                      "start": 90,
                      "end": 92
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 90,
                "end": 94
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
                          "Int": 3
                        },
                        "span": {
                          "start": 106,
                          "end": 107
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 101,
                    "end": 108
                  }
                }
              ]
            },
            "span": {
              "start": 68,
              "end": 116
            }
          }
        }
      },
      "span": {
        "start": 68,
        "end": 116
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "arr"
            },
            "span": {
              "start": 126,
              "end": 130
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 134,
              "end": 136
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
                          "Int": 4
                        },
                        "span": {
                          "start": 148,
                          "end": 149
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 143,
                    "end": 150
                  }
                }
              ]
            },
            "span": {
              "start": 117,
              "end": 162
            }
          }
        }
      },
      "span": {
        "start": 117,
        "end": 162
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 162
  }
}

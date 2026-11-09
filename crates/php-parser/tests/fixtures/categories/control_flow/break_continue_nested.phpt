===source===
<?php
for ($i = 0; $i < 10; $i++) {
    for ($j = 0; $j < 10; $j++) {
        break 2;
        continue 2;
    }
}
switch ($x) {
    case 1:
        break;
        break 1;
}
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
                    "For": {
                      "init": [
                        {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "j"
                                },
                                "span": {
                                  "start": 45,
                                  "end": 47
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 50,
                                  "end": 51
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 45,
                            "end": 51
                          }
                        }
                      ],
                      "condition": [
                        {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "j"
                                },
                                "span": {
                                  "start": 53,
                                  "end": 55
                                }
                              },
                              "op": "Less",
                              "right": {
                                "kind": {
                                  "Int": 10
                                },
                                "span": {
                                  "start": 58,
                                  "end": 60
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 53,
                            "end": 60
                          }
                        }
                      ],
                      "update": [
                        {
                          "kind": {
                            "UnaryPostfix": {
                              "operand": {
                                "kind": {
                                  "Variable": "j"
                                },
                                "span": {
                                  "start": 62,
                                  "end": 64
                                }
                              },
                              "op": "PostIncrement"
                            }
                          },
                          "span": {
                            "start": 62,
                            "end": 66
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
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 84,
                                    "end": 85
                                  }
                                }
                              },
                              "span": {
                                "start": 78,
                                "end": 86
                              }
                            },
                            {
                              "kind": {
                                "Continue": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 104,
                                    "end": 105
                                  }
                                }
                              },
                              "span": {
                                "start": 95,
                                "end": 106
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 68,
                          "end": 112
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 40,
                    "end": 112
                  }
                }
              ]
            },
            "span": {
              "start": 34,
              "end": 114
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 114
      }
    },
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 123,
              "end": 125
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 138,
                  "end": 139
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 149,
                    "end": 155
                  }
                },
                {
                  "kind": {
                    "Break": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 170,
                        "end": 171
                      }
                    }
                  },
                  "span": {
                    "start": 164,
                    "end": 172
                  }
                }
              ],
              "span": {
                "start": 133,
                "end": 172
              }
            }
          ]
        }
      },
      "span": {
        "start": 115,
        "end": 174
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 174
  }
}

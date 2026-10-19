===source===
<?php

[$a, $b] = [$c, $d];
[, $a, , , $b, ,] = $foo;
[, [[$a, , $x]], $b] = $bar;
['a' => $b, 'b' => $a] = $baz;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
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
                            "start": 8,
                            "end": 10
                          }
                        }
                      },
                      "span": {
                        "start": 8,
                        "end": 10
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
                            "start": 12,
                            "end": 14
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    }
                  ]
                },
                "span": {
                  "start": 7,
                  "end": 15
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 19,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 21
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "d"
                          },
                          "span": {
                            "start": 23,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 25
                      }
                    }
                  ]
                },
                "span": {
                  "start": 18,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 26
          }
        }
      },
      "span": {
        "start": 7,
        "end": 27
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 29,
                            "end": 30
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 31,
                            "end": 33
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 33
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 35,
                            "end": 36
                          }
                        }
                      },
                      "span": {
                        "start": 35,
                        "end": 36
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 37,
                            "end": 38
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 38
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
                            "start": 39,
                            "end": 41
                          }
                        }
                      },
                      "span": {
                        "start": 39,
                        "end": 41
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 43,
                            "end": 44
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 44
                      }
                    }
                  ]
                },
                "span": {
                  "start": 28,
                  "end": 45
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 48,
                  "end": 52
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 52
          }
        }
      },
      "span": {
        "start": 28,
        "end": 53
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 55,
                            "end": 56
                          }
                        }
                      },
                      "span": {
                        "start": 55,
                        "end": 56
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
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
                                                "start": 59,
                                                "end": 61
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 59,
                                            "end": 61
                                          }
                                        },
                                        {
                                          "key": null,
                                          "kind": {
                                            "Value": {
                                              "kind": "Omit",
                                              "span": {
                                                "start": 63,
                                                "end": 64
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 63,
                                            "end": 64
                                          }
                                        },
                                        {
                                          "key": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "x"
                                              },
                                              "span": {
                                                "start": 65,
                                                "end": 67
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 65,
                                            "end": 67
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 58,
                                      "end": 68
                                    }
                                  }
                                },
                                "span": {
                                  "start": 58,
                                  "end": 68
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 57,
                            "end": 69
                          }
                        }
                      },
                      "span": {
                        "start": 57,
                        "end": 69
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
                            "start": 71,
                            "end": 73
                          }
                        }
                      },
                      "span": {
                        "start": 71,
                        "end": 73
                      }
                    }
                  ]
                },
                "span": {
                  "start": 54,
                  "end": 74
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "bar"
                },
                "span": {
                  "start": 77,
                  "end": 81
                }
              }
            }
          },
          "span": {
            "start": 54,
            "end": 81
          }
        }
      },
      "span": {
        "start": 54,
        "end": 82
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "a"
                        },
                        "span": {
                          "start": 84,
                          "end": 87
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 91,
                            "end": 93
                          }
                        }
                      },
                      "span": {
                        "start": 84,
                        "end": 93
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "b"
                        },
                        "span": {
                          "start": 95,
                          "end": 98
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 102,
                            "end": 104
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 104
                      }
                    }
                  ]
                },
                "span": {
                  "start": 83,
                  "end": 105
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "baz"
                },
                "span": {
                  "start": 108,
                  "end": 112
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 112
          }
        }
      },
      "span": {
        "start": 83,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}

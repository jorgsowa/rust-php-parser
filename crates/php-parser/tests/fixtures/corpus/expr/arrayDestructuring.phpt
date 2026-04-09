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
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 8,
                          "end": 10,
                          "start_line": 3,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 8,
                        "end": 10,
                        "start_line": 3,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 12,
                          "end": 14,
                          "start_line": 3,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 14,
                        "start_line": 3,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 7,
                  "end": 15,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 19,
                          "end": 21,
                          "start_line": 3,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 19,
                        "end": 21,
                        "start_line": 3,
                        "start_col": 12
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "d"
                        },
                        "span": {
                          "start": 23,
                          "end": 25,
                          "start_line": 3,
                          "start_col": 16
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 23,
                        "end": 25,
                        "start_line": 3,
                        "start_col": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 18,
                  "end": 26,
                  "start_line": 3,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 26,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 28,
        "start_line": 3,
        "start_col": 0
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
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 29,
                          "end": 30,
                          "start_line": 4,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 29,
                        "end": 30,
                        "start_line": 4,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 31,
                          "end": 33,
                          "start_line": 4,
                          "start_col": 3
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 31,
                        "end": 33,
                        "start_line": 4,
                        "start_col": 3
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 35,
                          "end": 36,
                          "start_line": 4,
                          "start_col": 7
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 35,
                        "end": 36,
                        "start_line": 4,
                        "start_col": 7
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 37,
                          "end": 38,
                          "start_line": 4,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 37,
                        "end": 38,
                        "start_line": 4,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 39,
                          "end": 41,
                          "start_line": 4,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 39,
                        "end": 41,
                        "start_line": 4,
                        "start_col": 11
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 43,
                          "end": 44,
                          "start_line": 4,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 43,
                        "end": 44,
                        "start_line": 4,
                        "start_col": 15
                      }
                    }
                  ]
                },
                "span": {
                  "start": 28,
                  "end": 45,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 48,
                  "end": 52,
                  "start_line": 4,
                  "start_col": 20
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 52,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 28,
        "end": 54,
        "start_line": 4,
        "start_col": 0
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
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 55,
                          "end": 56,
                          "start_line": 5,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 55,
                        "end": 56,
                        "start_line": 5,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
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
                                          "start": 59,
                                          "end": 61,
                                          "start_line": 5,
                                          "start_col": 5
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 59,
                                        "end": 61,
                                        "start_line": 5,
                                        "start_col": 5
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": "Omit",
                                        "span": {
                                          "start": 63,
                                          "end": 64,
                                          "start_line": 5,
                                          "start_col": 9
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 63,
                                        "end": 64,
                                        "start_line": 5,
                                        "start_col": 9
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "x"
                                        },
                                        "span": {
                                          "start": 65,
                                          "end": 67,
                                          "start_line": 5,
                                          "start_col": 11
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 65,
                                        "end": 67,
                                        "start_line": 5,
                                        "start_col": 11
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 58,
                                  "end": 68,
                                  "start_line": 5,
                                  "start_col": 4
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 58,
                                "end": 68,
                                "start_line": 5,
                                "start_col": 4
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 57,
                          "end": 69,
                          "start_line": 5,
                          "start_col": 3
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 57,
                        "end": 69,
                        "start_line": 5,
                        "start_col": 3
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
                          "start_line": 5,
                          "start_col": 17
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 71,
                        "end": 73,
                        "start_line": 5,
                        "start_col": 17
                      }
                    }
                  ]
                },
                "span": {
                  "start": 54,
                  "end": 74,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "bar"
                },
                "span": {
                  "start": 77,
                  "end": 81,
                  "start_line": 5,
                  "start_col": 23
                }
              }
            }
          },
          "span": {
            "start": 54,
            "end": 81,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 54,
        "end": 83,
        "start_line": 5,
        "start_col": 0
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
                          "end": 87,
                          "start_line": 6,
                          "start_col": 1
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 91,
                          "end": 93,
                          "start_line": 6,
                          "start_col": 8
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 84,
                        "end": 93,
                        "start_line": 6,
                        "start_col": 1
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "b"
                        },
                        "span": {
                          "start": 95,
                          "end": 98,
                          "start_line": 6,
                          "start_col": 12
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 102,
                          "end": 104,
                          "start_line": 6,
                          "start_col": 19
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 95,
                        "end": 104,
                        "start_line": 6,
                        "start_col": 12
                      }
                    }
                  ]
                },
                "span": {
                  "start": 83,
                  "end": 105,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "baz"
                },
                "span": {
                  "start": 108,
                  "end": 112,
                  "start_line": 6,
                  "start_col": 25
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 112,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 83,
        "end": 113,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113,
    "start_line": 1,
    "start_col": 0
  }
}

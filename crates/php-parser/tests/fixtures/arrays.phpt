===source===
<?php
$empty = [];
$numbers = [1, 2, 3];
$map = ['name' => 'PHP', 'version' => 8];
$nested = [[1, 2], [3, 4]];
$first = $numbers[0];
$name = $map['name'];
$deep = $nested[0][1];
$trailing = [1, 2, 3,];
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
                  "Variable": "empty"
                },
                "span": {
                  "start": 6,
                  "end": 12,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 15,
                  "end": 17,
                  "start_line": 2,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19,
        "start_line": 2,
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
                  "Variable": "numbers"
                },
                "span": {
                  "start": 19,
                  "end": 27,
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
                          "Int": 1
                        },
                        "span": {
                          "start": 31,
                          "end": 32,
                          "start_line": 3,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 31,
                        "end": 32,
                        "start_line": 3,
                        "start_col": 12
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 34,
                          "end": 35,
                          "start_line": 3,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 34,
                        "end": 35,
                        "start_line": 3,
                        "start_col": 15
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 37,
                          "end": 38,
                          "start_line": 3,
                          "start_col": 18
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 37,
                        "end": 38,
                        "start_line": 3,
                        "start_col": 18
                      }
                    }
                  ]
                },
                "span": {
                  "start": 30,
                  "end": 39,
                  "start_line": 3,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 39,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 19,
        "end": 41,
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
                  "Variable": "map"
                },
                "span": {
                  "start": 41,
                  "end": 45,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "name"
                        },
                        "span": {
                          "start": 49,
                          "end": 55,
                          "start_line": 4,
                          "start_col": 8
                        }
                      },
                      "value": {
                        "kind": {
                          "String": "PHP"
                        },
                        "span": {
                          "start": 59,
                          "end": 64,
                          "start_line": 4,
                          "start_col": 18
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 49,
                        "end": 64,
                        "start_line": 4,
                        "start_col": 8
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "version"
                        },
                        "span": {
                          "start": 66,
                          "end": 75,
                          "start_line": 4,
                          "start_col": 25
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 8
                        },
                        "span": {
                          "start": 79,
                          "end": 80,
                          "start_line": 4,
                          "start_col": 38
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 66,
                        "end": 80,
                        "start_line": 4,
                        "start_col": 25
                      }
                    }
                  ]
                },
                "span": {
                  "start": 48,
                  "end": 81,
                  "start_line": 4,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 81,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 41,
        "end": 83,
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
                  "Variable": "nested"
                },
                "span": {
                  "start": 83,
                  "end": 90,
                  "start_line": 5,
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
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 95,
                                  "end": 96,
                                  "start_line": 5,
                                  "start_col": 12
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 95,
                                "end": 96,
                                "start_line": 5,
                                "start_col": 12
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 98,
                                  "end": 99,
                                  "start_line": 5,
                                  "start_col": 15
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 98,
                                "end": 99,
                                "start_line": 5,
                                "start_col": 15
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 94,
                          "end": 100,
                          "start_line": 5,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 94,
                        "end": 100,
                        "start_line": 5,
                        "start_col": 11
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
                                  "Int": 3
                                },
                                "span": {
                                  "start": 103,
                                  "end": 104,
                                  "start_line": 5,
                                  "start_col": 20
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 103,
                                "end": 104,
                                "start_line": 5,
                                "start_col": 20
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 4
                                },
                                "span": {
                                  "start": 106,
                                  "end": 107,
                                  "start_line": 5,
                                  "start_col": 23
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 106,
                                "end": 107,
                                "start_line": 5,
                                "start_col": 23
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 102,
                          "end": 108,
                          "start_line": 5,
                          "start_col": 19
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 102,
                        "end": 108,
                        "start_line": 5,
                        "start_col": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 93,
                  "end": 109,
                  "start_line": 5,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 109,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 83,
        "end": 111,
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
                  "Variable": "first"
                },
                "span": {
                  "start": 111,
                  "end": 117,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "numbers"
                      },
                      "span": {
                        "start": 120,
                        "end": 128,
                        "start_line": 6,
                        "start_col": 9
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 129,
                        "end": 130,
                        "start_line": 6,
                        "start_col": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 120,
                  "end": 131,
                  "start_line": 6,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 111,
            "end": 131,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 111,
        "end": 133,
        "start_line": 6,
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
                  "Variable": "name"
                },
                "span": {
                  "start": 133,
                  "end": 138,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "map"
                      },
                      "span": {
                        "start": 141,
                        "end": 145,
                        "start_line": 7,
                        "start_col": 8
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "name"
                      },
                      "span": {
                        "start": 146,
                        "end": 152,
                        "start_line": 7,
                        "start_col": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 141,
                  "end": 153,
                  "start_line": 7,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 133,
            "end": 153,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 133,
        "end": 155,
        "start_line": 7,
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
                  "Variable": "deep"
                },
                "span": {
                  "start": 155,
                  "end": 160,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "nested"
                            },
                            "span": {
                              "start": 163,
                              "end": 170,
                              "start_line": 8,
                              "start_col": 8
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 171,
                              "end": 172,
                              "start_line": 8,
                              "start_col": 16
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 163,
                        "end": 173,
                        "start_line": 8,
                        "start_col": 8
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 174,
                        "end": 175,
                        "start_line": 8,
                        "start_col": 19
                      }
                    }
                  }
                },
                "span": {
                  "start": 163,
                  "end": 176,
                  "start_line": 8,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 155,
            "end": 176,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 155,
        "end": 178,
        "start_line": 8,
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
                  "Variable": "trailing"
                },
                "span": {
                  "start": 178,
                  "end": 187,
                  "start_line": 9,
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
                          "Int": 1
                        },
                        "span": {
                          "start": 191,
                          "end": 192,
                          "start_line": 9,
                          "start_col": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 191,
                        "end": 192,
                        "start_line": 9,
                        "start_col": 13
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 194,
                          "end": 195,
                          "start_line": 9,
                          "start_col": 16
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 194,
                        "end": 195,
                        "start_line": 9,
                        "start_col": 16
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 197,
                          "end": 198,
                          "start_line": 9,
                          "start_col": 19
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 197,
                        "end": 198,
                        "start_line": 9,
                        "start_col": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 190,
                  "end": 200,
                  "start_line": 9,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 178,
            "end": 200,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 178,
        "end": 201,
        "start_line": 9,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 201,
    "start_line": 1,
    "start_col": 0
  }
}

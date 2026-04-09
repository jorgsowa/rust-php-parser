===source===
<?php
$data = [1, 2, 3, 4, 5];
$sum = 0;
foreach ($data as $item) {
    $sum = $sum + $item;
}
$map = ['a' => 1, 'b' => 2];
$val = $map['a'];
echo $sum;
echo $val;
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
                  "Variable": "data"
                },
                "span": {
                  "start": 6,
                  "end": 11,
                  "start_line": 2,
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
                          "start": 15,
                          "end": 16,
                          "start_line": 2,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 16,
                        "start_line": 2,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 18,
                          "end": 19,
                          "start_line": 2,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 18,
                        "end": 19,
                        "start_line": 2,
                        "start_col": 12
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 21,
                          "end": 22,
                          "start_line": 2,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 21,
                        "end": 22,
                        "start_line": 2,
                        "start_col": 15
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 4
                        },
                        "span": {
                          "start": 24,
                          "end": 25,
                          "start_line": 2,
                          "start_col": 18
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 24,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 18
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 5
                        },
                        "span": {
                          "start": 27,
                          "end": 28,
                          "start_line": 2,
                          "start_col": 21
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 27,
                        "end": 28,
                        "start_line": 2,
                        "start_col": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 14,
                  "end": 29,
                  "start_line": 2,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31,
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
                  "Variable": "sum"
                },
                "span": {
                  "start": 31,
                  "end": 35,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 38,
                  "end": 39,
                  "start_line": 3,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 31,
            "end": 39,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 31,
        "end": 41,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "data"
            },
            "span": {
              "start": 50,
              "end": 55,
              "start_line": 4,
              "start_col": 9
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "item"
            },
            "span": {
              "start": 59,
              "end": 64,
              "start_line": 4,
              "start_col": 18
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "sum"
                            },
                            "span": {
                              "start": 72,
                              "end": 76,
                              "start_line": 5,
                              "start_col": 4
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "sum"
                                  },
                                  "span": {
                                    "start": 79,
                                    "end": 83,
                                    "start_line": 5,
                                    "start_col": 11
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Variable": "item"
                                  },
                                  "span": {
                                    "start": 86,
                                    "end": 91,
                                    "start_line": 5,
                                    "start_col": 18
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 79,
                              "end": 91,
                              "start_line": 5,
                              "start_col": 11
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 72,
                        "end": 91,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 72,
                    "end": 93,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 66,
              "end": 94,
              "start_line": 4,
              "start_col": 25
            }
          }
        }
      },
      "span": {
        "start": 41,
        "end": 94,
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
                  "Variable": "map"
                },
                "span": {
                  "start": 95,
                  "end": 99,
                  "start_line": 7,
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
                          "String": "a"
                        },
                        "span": {
                          "start": 103,
                          "end": 106,
                          "start_line": 7,
                          "start_col": 8
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 110,
                          "end": 111,
                          "start_line": 7,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 103,
                        "end": 111,
                        "start_line": 7,
                        "start_col": 8
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "b"
                        },
                        "span": {
                          "start": 113,
                          "end": 116,
                          "start_line": 7,
                          "start_col": 18
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 120,
                          "end": 121,
                          "start_line": 7,
                          "start_col": 25
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 113,
                        "end": 121,
                        "start_line": 7,
                        "start_col": 18
                      }
                    }
                  ]
                },
                "span": {
                  "start": 102,
                  "end": 122,
                  "start_line": 7,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 95,
            "end": 122,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 95,
        "end": 124,
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
                  "Variable": "val"
                },
                "span": {
                  "start": 124,
                  "end": 128,
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
                        "Variable": "map"
                      },
                      "span": {
                        "start": 131,
                        "end": 135,
                        "start_line": 8,
                        "start_col": 7
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 136,
                        "end": 139,
                        "start_line": 8,
                        "start_col": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 131,
                  "end": 140,
                  "start_line": 8,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 124,
            "end": 140,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 124,
        "end": 142,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "sum"
            },
            "span": {
              "start": 147,
              "end": 151,
              "start_line": 9,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 142,
        "end": 153,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "val"
            },
            "span": {
              "start": 158,
              "end": 162,
              "start_line": 10,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 153,
        "end": 163,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163,
    "start_line": 1,
    "start_col": 0
  }
}

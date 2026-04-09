===source===
<?php
[, , $third] = $arr;
[[$a, $b], [$c, $d]] = $matrix;
['name' => $name, 'address' => ['city' => $city]] = $data;
[1 => $second, 0 => $first] = $arr;
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
                        "kind": "Omit",
                        "span": {
                          "start": 7,
                          "end": 8,
                          "start_line": 2,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 8,
                        "start_line": 2,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 9,
                          "end": 10,
                          "start_line": 2,
                          "start_col": 3
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 9,
                        "end": 10,
                        "start_line": 2,
                        "start_col": 3
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "third"
                        },
                        "span": {
                          "start": 11,
                          "end": 17,
                          "start_line": 2,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 17,
                        "start_line": 2,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 18,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 21,
                  "end": 25,
                  "start_line": 2,
                  "start_col": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
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
                                  "start": 29,
                                  "end": 31,
                                  "start_line": 3,
                                  "start_col": 2
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 29,
                                "end": 31,
                                "start_line": 3,
                                "start_col": 2
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 33,
                                  "end": 35,
                                  "start_line": 3,
                                  "start_col": 6
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 33,
                                "end": 35,
                                "start_line": 3,
                                "start_col": 6
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 28,
                          "end": 36,
                          "start_line": 3,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 28,
                        "end": 36,
                        "start_line": 3,
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
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 39,
                                  "end": 41,
                                  "start_line": 3,
                                  "start_col": 12
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 39,
                                "end": 41,
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
                                  "start": 43,
                                  "end": 45,
                                  "start_line": 3,
                                  "start_col": 16
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 43,
                                "end": 45,
                                "start_line": 3,
                                "start_col": 16
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 38,
                          "end": 46,
                          "start_line": 3,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 38,
                        "end": 46,
                        "start_line": 3,
                        "start_col": 11
                      }
                    }
                  ]
                },
                "span": {
                  "start": 27,
                  "end": 47,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "matrix"
                },
                "span": {
                  "start": 50,
                  "end": 57,
                  "start_line": 3,
                  "start_col": 23
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 57,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 27,
        "end": 59,
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
                      "key": {
                        "kind": {
                          "String": "name"
                        },
                        "span": {
                          "start": 60,
                          "end": 66,
                          "start_line": 4,
                          "start_col": 1
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "name"
                        },
                        "span": {
                          "start": 70,
                          "end": 75,
                          "start_line": 4,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 60,
                        "end": 75,
                        "start_line": 4,
                        "start_col": 1
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "address"
                        },
                        "span": {
                          "start": 77,
                          "end": 86,
                          "start_line": 4,
                          "start_col": 18
                        }
                      },
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": {
                                "kind": {
                                  "String": "city"
                                },
                                "span": {
                                  "start": 91,
                                  "end": 97,
                                  "start_line": 4,
                                  "start_col": 32
                                }
                              },
                              "value": {
                                "kind": {
                                  "Variable": "city"
                                },
                                "span": {
                                  "start": 101,
                                  "end": 106,
                                  "start_line": 4,
                                  "start_col": 42
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 91,
                                "end": 106,
                                "start_line": 4,
                                "start_col": 32
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 90,
                          "end": 107,
                          "start_line": 4,
                          "start_col": 31
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 77,
                        "end": 107,
                        "start_line": 4,
                        "start_col": 18
                      }
                    }
                  ]
                },
                "span": {
                  "start": 59,
                  "end": 108,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "data"
                },
                "span": {
                  "start": 111,
                  "end": 116,
                  "start_line": 4,
                  "start_col": 52
                }
              }
            }
          },
          "span": {
            "start": 59,
            "end": 116,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 59,
        "end": 118,
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
                      "key": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 119,
                          "end": 120,
                          "start_line": 5,
                          "start_col": 1
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "second"
                        },
                        "span": {
                          "start": 124,
                          "end": 131,
                          "start_line": 5,
                          "start_col": 6
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 119,
                        "end": 131,
                        "start_line": 5,
                        "start_col": 1
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 133,
                          "end": 134,
                          "start_line": 5,
                          "start_col": 15
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "first"
                        },
                        "span": {
                          "start": 138,
                          "end": 144,
                          "start_line": 5,
                          "start_col": 20
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 133,
                        "end": 144,
                        "start_line": 5,
                        "start_col": 15
                      }
                    }
                  ]
                },
                "span": {
                  "start": 118,
                  "end": 145,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 148,
                  "end": 152,
                  "start_line": 5,
                  "start_col": 30
                }
              }
            }
          },
          "span": {
            "start": 118,
            "end": 152,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 118,
        "end": 153,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 153,
    "start_line": 1,
    "start_col": 0
  }
}

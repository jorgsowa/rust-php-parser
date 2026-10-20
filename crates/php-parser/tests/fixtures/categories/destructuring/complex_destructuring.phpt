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
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 7,
                            "end": 8
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 8
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 9,
                            "end": 10
                          }
                        }
                      },
                      "span": {
                        "start": 9,
                        "end": 10
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "third"
                          },
                          "span": {
                            "start": 11,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 17
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 21,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
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
                                      "start": 29,
                                      "end": 31
                                    }
                                  }
                                },
                                "span": {
                                  "start": 29,
                                  "end": 31
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
                                      "start": 33,
                                      "end": 35
                                    }
                                  }
                                },
                                "span": {
                                  "start": 33,
                                  "end": 35
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 28,
                            "end": 36
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 36
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
                                      "Variable": "c"
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
                                    "kind": {
                                      "Variable": "d"
                                    },
                                    "span": {
                                      "start": 43,
                                      "end": 45
                                    }
                                  }
                                },
                                "span": {
                                  "start": 43,
                                  "end": 45
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 38,
                            "end": 46
                          }
                        }
                      },
                      "span": {
                        "start": 38,
                        "end": 46
                      }
                    }
                  ]
                },
                "span": {
                  "start": 27,
                  "end": 47
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "matrix"
                },
                "span": {
                  "start": 50,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 57
          }
        }
      },
      "span": {
        "start": 27,
        "end": 58
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
                          "end": 66
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "name"
                          },
                          "span": {
                            "start": 70,
                            "end": 75
                          }
                        }
                      },
                      "span": {
                        "start": 60,
                        "end": 75
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "address"
                        },
                        "span": {
                          "start": 77,
                          "end": 86
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": {
                                  "kind": {
                                    "String": "city"
                                  },
                                  "span": {
                                    "start": 91,
                                    "end": 97
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "city"
                                    },
                                    "span": {
                                      "start": 101,
                                      "end": 106
                                    }
                                  }
                                },
                                "span": {
                                  "start": 91,
                                  "end": 106
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 90,
                            "end": 107
                          }
                        }
                      },
                      "span": {
                        "start": 77,
                        "end": 107
                      }
                    }
                  ]
                },
                "span": {
                  "start": 59,
                  "end": 108
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "data"
                },
                "span": {
                  "start": 111,
                  "end": 116
                }
              }
            }
          },
          "span": {
            "start": 59,
            "end": 116
          }
        }
      },
      "span": {
        "start": 59,
        "end": 117
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
                          "end": 120
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "second"
                          },
                          "span": {
                            "start": 124,
                            "end": 131
                          }
                        }
                      },
                      "span": {
                        "start": 119,
                        "end": 131
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 133,
                          "end": 134
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "first"
                          },
                          "span": {
                            "start": 138,
                            "end": 144
                          }
                        }
                      },
                      "span": {
                        "start": 133,
                        "end": 144
                      }
                    }
                  ]
                },
                "span": {
                  "start": 118,
                  "end": 145
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 148,
                  "end": 152
                }
              }
            }
          },
          "span": {
            "start": 118,
            "end": 152
          }
        }
      },
      "span": {
        "start": 118,
        "end": 153
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 153
  }
}

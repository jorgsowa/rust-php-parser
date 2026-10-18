===source===
<?php
[[]] = $a;
[$x, []] = $a;
[$x, [,]] = $a;
['k' => []] = $a;
[[[]]] = $a;
list($x, list()) = $a;
list(list(,)) = $a;
foreach ($a as []) {}
foreach ($a as [,]) {}
foreach ($a as $k => list()) {}
foreach ($a as [$x, []]) {}
===errors===
Cannot use empty list
Cannot use empty list
Cannot use empty list
Cannot use empty list
Cannot use empty list
Cannot use empty list
Cannot use empty list
Cannot use empty list
Cannot use empty list
Cannot use empty list
Cannot use empty list
===php_error===
PHP Fatal error:  Cannot use empty list in Standard input code on line 2
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
                          "Array": []
                        },
                        "span": {
                          "start": 7,
                          "end": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
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
                          "Variable": "x"
                        },
                        "span": {
                          "start": 18,
                          "end": 20
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": []
                        },
                        "span": {
                          "start": 22,
                          "end": 24
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 22,
                        "end": 24
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 25
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 28,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 30
          }
        }
      },
      "span": {
        "start": 17,
        "end": 31
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
                          "Variable": "x"
                        },
                        "span": {
                          "start": 33,
                          "end": 35
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 33,
                        "end": 35
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
                                "kind": "Omit",
                                "span": {
                                  "start": 38,
                                  "end": 39
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 38,
                                "end": 39
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 37,
                          "end": 40
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 37,
                        "end": 40
                      }
                    }
                  ]
                },
                "span": {
                  "start": 32,
                  "end": 41
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 44,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 46
          }
        }
      },
      "span": {
        "start": 32,
        "end": 47
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
                          "String": "k"
                        },
                        "span": {
                          "start": 49,
                          "end": 52
                        }
                      },
                      "value": {
                        "kind": {
                          "Array": []
                        },
                        "span": {
                          "start": 56,
                          "end": 58
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 49,
                        "end": 58
                      }
                    }
                  ]
                },
                "span": {
                  "start": 48,
                  "end": 59
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 62,
                  "end": 64
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 64
          }
        }
      },
      "span": {
        "start": 48,
        "end": 65
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
                                  "Array": []
                                },
                                "span": {
                                  "start": 68,
                                  "end": 70
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 68,
                                "end": 70
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 67,
                          "end": 71
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 67,
                        "end": 71
                      }
                    }
                  ]
                },
                "span": {
                  "start": 66,
                  "end": 72
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 75,
                  "end": 77
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 77
          }
        }
      },
      "span": {
        "start": 66,
        "end": 78
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
                          "Variable": "x"
                        },
                        "span": {
                          "start": 84,
                          "end": 86
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 84,
                        "end": 86
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": []
                        },
                        "span": {
                          "start": 88,
                          "end": 94
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 88,
                        "end": 94
                      }
                    }
                  ]
                },
                "span": {
                  "start": 79,
                  "end": 95
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 98,
                  "end": 100
                }
              }
            }
          },
          "span": {
            "start": 79,
            "end": 100
          }
        }
      },
      "span": {
        "start": 79,
        "end": 101
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
                                "kind": "Omit",
                                "span": {
                                  "start": 112,
                                  "end": 113
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 112,
                                "end": 113
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 107,
                          "end": 114
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 107,
                        "end": 114
                      }
                    }
                  ]
                },
                "span": {
                  "start": 102,
                  "end": 115
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 118,
                  "end": 120
                }
              }
            }
          },
          "span": {
            "start": 102,
            "end": 120
          }
        }
      },
      "span": {
        "start": 102,
        "end": 121
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 131,
              "end": 133
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": []
            },
            "span": {
              "start": 137,
              "end": 139
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 141,
              "end": 143
            }
          }
        }
      },
      "span": {
        "start": 122,
        "end": 143
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 153,
              "end": 155
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": "Omit",
                    "span": {
                      "start": 160,
                      "end": 161
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 160,
                    "end": 161
                  }
                }
              ]
            },
            "span": {
              "start": 159,
              "end": 162
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 164,
              "end": 166
            }
          }
        }
      },
      "span": {
        "start": 144,
        "end": 166
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 176,
              "end": 178
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 182,
              "end": 184
            }
          },
          "value": {
            "kind": {
              "Array": []
            },
            "span": {
              "start": 188,
              "end": 194
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 196,
              "end": 198
            }
          }
        }
      },
      "span": {
        "start": 167,
        "end": 198
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 208,
              "end": 210
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 215,
                      "end": 217
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 215,
                    "end": 217
                  }
                },
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 219,
                      "end": 221
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 219,
                    "end": 221
                  }
                }
              ]
            },
            "span": {
              "start": 214,
              "end": 222
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 224,
              "end": 226
            }
          }
        }
      },
      "span": {
        "start": 199,
        "end": 226
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 226
  }
}

===source===
<?php
[$a] = $b;
[$a, [$b]] = $c;
list($a, list($b)) = $c;
['k' => $a] = $b;
[, $a] = $b;
$a += [1];
$a[0] += 1;
$a->b .= 'x';
$a ??= [$b];
$a = [$b] + [$c];
$a = [$b] . 'x';
[$a][0];
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
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
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
                  "Variable": "b"
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
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 18,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 20
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
                                      "Variable": "b"
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
                            "start": 22,
                            "end": 26
                          }
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 26
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 27
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 30,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 32
          }
        }
      },
      "span": {
        "start": 17,
        "end": 33
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
                            "Variable": "a"
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
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 48,
                                      "end": 50
                                    }
                                  }
                                },
                                "span": {
                                  "start": 48,
                                  "end": 50
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 43,
                            "end": 51
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 51
                      }
                    }
                  ]
                },
                "span": {
                  "start": 34,
                  "end": 52
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 55,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 57
          }
        }
      },
      "span": {
        "start": 34,
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
                          "String": "k"
                        },
                        "span": {
                          "start": 60,
                          "end": 63
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 67,
                            "end": 69
                          }
                        }
                      },
                      "span": {
                        "start": 60,
                        "end": 69
                      }
                    }
                  ]
                },
                "span": {
                  "start": 59,
                  "end": 70
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 73,
                  "end": 75
                }
              }
            }
          },
          "span": {
            "start": 59,
            "end": 75
          }
        }
      },
      "span": {
        "start": 59,
        "end": 76
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
                            "start": 78,
                            "end": 79
                          }
                        }
                      },
                      "span": {
                        "start": 78,
                        "end": 79
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
                            "start": 80,
                            "end": 82
                          }
                        }
                      },
                      "span": {
                        "start": 80,
                        "end": 82
                      }
                    }
                  ]
                },
                "span": {
                  "start": 77,
                  "end": 83
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 86,
                  "end": 88
                }
              }
            }
          },
          "span": {
            "start": 77,
            "end": 88
          }
        }
      },
      "span": {
        "start": 77,
        "end": 89
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 90,
                  "end": 92
                }
              },
              "op": "Plus",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 97,
                            "end": 98
                          }
                        }
                      },
                      "span": {
                        "start": 97,
                        "end": 98
                      }
                    }
                  ]
                },
                "span": {
                  "start": 96,
                  "end": 99
                }
              }
            }
          },
          "span": {
            "start": 90,
            "end": 99
          }
        }
      },
      "span": {
        "start": 90,
        "end": 100
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 101,
                        "end": 103
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 104,
                        "end": 105
                      }
                    }
                  }
                },
                "span": {
                  "start": 101,
                  "end": 106
                }
              },
              "op": "Plus",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 110,
                  "end": 111
                }
              }
            }
          },
          "span": {
            "start": 101,
            "end": 111
          }
        }
      },
      "span": {
        "start": 101,
        "end": 112
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 113,
                        "end": 115
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 117,
                        "end": 118
                      }
                    }
                  }
                },
                "span": {
                  "start": 113,
                  "end": 118
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 122,
                  "end": 125
                }
              }
            }
          },
          "span": {
            "start": 113,
            "end": 125
          }
        }
      },
      "span": {
        "start": 113,
        "end": 126
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 127,
                  "end": 129
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 135,
                            "end": 137
                          }
                        }
                      },
                      "span": {
                        "start": 135,
                        "end": 137
                      }
                    }
                  ]
                },
                "span": {
                  "start": 134,
                  "end": 138
                }
              }
            }
          },
          "span": {
            "start": 127,
            "end": 138
          }
        }
      },
      "span": {
        "start": 127,
        "end": 139
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 140,
                  "end": 142
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 146,
                                  "end": 148
                                }
                              }
                            },
                            "span": {
                              "start": 146,
                              "end": 148
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 145,
                        "end": 149
                      }
                    },
                    "op": "Add",
                    "right": {
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
                                  "start": 153,
                                  "end": 155
                                }
                              }
                            },
                            "span": {
                              "start": 153,
                              "end": 155
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 152,
                        "end": 156
                      }
                    }
                  }
                },
                "span": {
                  "start": 145,
                  "end": 156
                }
              }
            }
          },
          "span": {
            "start": 140,
            "end": 156
          }
        }
      },
      "span": {
        "start": 140,
        "end": 157
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 158,
                  "end": 160
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 164,
                                  "end": 166
                                }
                              }
                            },
                            "span": {
                              "start": 164,
                              "end": 166
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 163,
                        "end": 167
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "x"
                      },
                      "span": {
                        "start": 170,
                        "end": 173
                      }
                    }
                  }
                },
                "span": {
                  "start": 163,
                  "end": 173
                }
              }
            }
          },
          "span": {
            "start": 158,
            "end": 173
          }
        }
      },
      "span": {
        "start": 158,
        "end": 174
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
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
                            "start": 176,
                            "end": 178
                          }
                        }
                      },
                      "span": {
                        "start": 176,
                        "end": 178
                      }
                    }
                  ]
                },
                "span": {
                  "start": 175,
                  "end": 179
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 180,
                  "end": 181
                }
              }
            }
          },
          "span": {
            "start": 175,
            "end": 182
          }
        }
      },
      "span": {
        "start": 175,
        "end": 183
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 183
  }
}

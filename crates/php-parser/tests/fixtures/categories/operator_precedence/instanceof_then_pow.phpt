===source===
<?php
$x = $a instanceof B ** 2;
$x = $a instanceof $b ** 2;
$x = $a instanceof $b->c ** 2;
$x = $a instanceof B::$c[0] ** 2;
$x = $a instanceof (B) ** 2;
$x = $a instanceof B * 2;
$x = 2 ** $a instanceof B;
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 6
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 11,
                              "end": 13
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 25,
                                  "end": 26
                                }
                              }
                            },
                            "span": {
                              "start": 25,
                              "end": 26
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 26
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 30,
                        "end": 31
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 33,
                  "end": 35
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 38,
                              "end": 40
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 52,
                              "end": 54
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 38,
                        "end": 54
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 58,
                        "end": 59
                      }
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 59
          }
        }
      },
      "span": {
        "start": 33,
        "end": 60
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 61,
                  "end": 63
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 66,
                              "end": 68
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "PropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 80,
                                    "end": 82
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "c"
                                  },
                                  "span": {
                                    "start": 84,
                                    "end": 85
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 80,
                              "end": 85
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 66,
                        "end": 85
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 89,
                        "end": 90
                      }
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 90
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 90
          }
        }
      },
      "span": {
        "start": 61,
        "end": 91
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 92,
                  "end": 94
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 97,
                              "end": 99
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "StaticPropertyAccess": {
                                      "class": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "B"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 111,
                                              "end": 112
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 111,
                                          "end": 112
                                        }
                                      },
                                      "member": {
                                        "kind": {
                                          "Identifier": "c"
                                        },
                                        "span": {
                                          "start": 114,
                                          "end": 116
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 111,
                                    "end": 116
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 117,
                                    "end": 118
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 111,
                              "end": 119
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 97,
                        "end": 119
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 123,
                        "end": 124
                      }
                    }
                  }
                },
                "span": {
                  "start": 97,
                  "end": 124
                }
              }
            }
          },
          "span": {
            "start": 92,
            "end": 124
          }
        }
      },
      "span": {
        "start": 92,
        "end": 125
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 126,
                  "end": 128
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 131,
                              "end": 133
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "B"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 146,
                                      "end": 147
                                    }
                                  }
                                },
                                "span": {
                                  "start": 146,
                                  "end": 147
                                }
                              }
                            },
                            "span": {
                              "start": 145,
                              "end": 148
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 131,
                        "end": 148
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 152,
                        "end": 153
                      }
                    }
                  }
                },
                "span": {
                  "start": 131,
                  "end": 153
                }
              }
            }
          },
          "span": {
            "start": 126,
            "end": 153
          }
        }
      },
      "span": {
        "start": 126,
        "end": 154
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 155,
                  "end": 157
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 160,
                              "end": 162
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 174,
                                  "end": 175
                                }
                              }
                            },
                            "span": {
                              "start": 174,
                              "end": 175
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 160,
                        "end": 175
                      }
                    },
                    "op": "Mul",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 178,
                        "end": 179
                      }
                    }
                  }
                },
                "span": {
                  "start": 160,
                  "end": 179
                }
              }
            }
          },
          "span": {
            "start": 155,
            "end": 179
          }
        }
      },
      "span": {
        "start": 155,
        "end": 180
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 181,
                  "end": 183
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 186,
                              "end": 187
                            }
                          },
                          "op": "Pow",
                          "right": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 191,
                              "end": 193
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 186,
                        "end": 193
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 205,
                            "end": 206
                          }
                        }
                      },
                      "span": {
                        "start": 205,
                        "end": 206
                      }
                    }
                  }
                },
                "span": {
                  "start": 186,
                  "end": 206
                }
              }
            }
          },
          "span": {
            "start": 181,
            "end": 206
          }
        }
      },
      "span": {
        "start": 181,
        "end": 207
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 207
  }
}

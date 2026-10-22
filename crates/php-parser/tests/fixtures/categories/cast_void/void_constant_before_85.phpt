===source===
<?php
$x = (void);
f((void), (VOID));
$x = (void) + 1;
$x = (void)[0];
$x = (void)::class;
$x = (void) ?? 1;
$x = (void) . 'a';
$x = (void) - $y;
$x = (void)->a;
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "(void)" in Standard input code on line 2
===ast 8.4===
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
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 12,
                          "end": 16
                        }
                      }
                    },
                    "span": {
                      "start": 12,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 20
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 20
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
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
                      },
                      "span": {
                        "start": 21,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 27
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "VOID"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 30,
                                "end": 34
                              }
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 35
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 35
                  }
                }
              ]
            }
          },
          "span": {
            "start": 19,
            "end": 36
          }
        }
      },
      "span": {
        "start": 19,
        "end": 37
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
                  "start": 38,
                  "end": 40
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 44,
                                "end": 48
                              }
                            }
                          },
                          "span": {
                            "start": 44,
                            "end": 48
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 49
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 52,
                        "end": 53
                      }
                    }
                  }
                },
                "span": {
                  "start": 43,
                  "end": 53
                }
              }
            }
          },
          "span": {
            "start": 38,
            "end": 53
          }
        }
      },
      "span": {
        "start": 38,
        "end": 54
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
                  "start": 55,
                  "end": 57
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 61,
                                "end": 65
                              }
                            }
                          },
                          "span": {
                            "start": 61,
                            "end": 65
                          }
                        }
                      },
                      "span": {
                        "start": 60,
                        "end": 66
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 67,
                        "end": 68
                      }
                    }
                  }
                },
                "span": {
                  "start": 60,
                  "end": 69
                }
              }
            }
          },
          "span": {
            "start": 55,
            "end": 69
          }
        }
      },
      "span": {
        "start": 55,
        "end": 70
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
                  "start": 71,
                  "end": 73
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 77,
                                "end": 81
                              }
                            }
                          },
                          "span": {
                            "start": 77,
                            "end": 81
                          }
                        }
                      },
                      "span": {
                        "start": 76,
                        "end": 82
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 84,
                        "end": 89
                      }
                    }
                  }
                },
                "span": {
                  "start": 76,
                  "end": 89
                }
              }
            }
          },
          "span": {
            "start": 71,
            "end": 89
          }
        }
      },
      "span": {
        "start": 71,
        "end": 90
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
                  "start": 91,
                  "end": 93
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 97,
                                "end": 101
                              }
                            }
                          },
                          "span": {
                            "start": 97,
                            "end": 101
                          }
                        }
                      },
                      "span": {
                        "start": 96,
                        "end": 102
                      }
                    },
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 106,
                        "end": 107
                      }
                    }
                  }
                },
                "span": {
                  "start": 96,
                  "end": 107
                }
              }
            }
          },
          "span": {
            "start": 91,
            "end": 107
          }
        }
      },
      "span": {
        "start": 91,
        "end": 108
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
                  "start": 109,
                  "end": 111
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 115,
                                "end": 119
                              }
                            }
                          },
                          "span": {
                            "start": 115,
                            "end": 119
                          }
                        }
                      },
                      "span": {
                        "start": 114,
                        "end": 120
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 123,
                        "end": 126
                      }
                    }
                  }
                },
                "span": {
                  "start": 114,
                  "end": 126
                }
              }
            }
          },
          "span": {
            "start": 109,
            "end": 126
          }
        }
      },
      "span": {
        "start": 109,
        "end": 127
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
                  "start": 128,
                  "end": 130
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 134,
                                "end": 138
                              }
                            }
                          },
                          "span": {
                            "start": 134,
                            "end": 138
                          }
                        }
                      },
                      "span": {
                        "start": 133,
                        "end": 139
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 142,
                        "end": 144
                      }
                    }
                  }
                },
                "span": {
                  "start": 133,
                  "end": 144
                }
              }
            }
          },
          "span": {
            "start": 128,
            "end": 144
          }
        }
      },
      "span": {
        "start": 128,
        "end": 145
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
                  "start": 146,
                  "end": 148
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 152,
                                "end": 156
                              }
                            }
                          },
                          "span": {
                            "start": 152,
                            "end": 156
                          }
                        }
                      },
                      "span": {
                        "start": 151,
                        "end": 157
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 159,
                        "end": 160
                      }
                    }
                  }
                },
                "span": {
                  "start": 151,
                  "end": 160
                }
              }
            }
          },
          "span": {
            "start": 146,
            "end": 160
          }
        }
      },
      "span": {
        "start": 146,
        "end": 161
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 161
  }
}

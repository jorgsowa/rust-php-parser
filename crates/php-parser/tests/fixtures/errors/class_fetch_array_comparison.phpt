===source===
<?php
([] == [])::class;
([] === [])::class;
([] < [1])::class;
([1] === [2, 3])::class;
(1 < [])::class;
([] > 'a')::class;
([] == null)::class;
([] <=> [1])::class;
[] == [] && isset(1 + 1);
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===errors >=8.0===
Cannot use "::class" on true
Cannot use "::class" on true
Cannot use "::class" on true
Cannot use "::class" on false
Cannot use "::class" on true
Cannot use "::class" on true
Cannot use "::class" on true
Cannot use "::class" on int
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type bool in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on true in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        },
                        "op": "Equal",
                        "right": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 18,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 26,
                            "end": 28
                          }
                        },
                        "op": "Identical",
                        "right": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 33,
                            "end": 35
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 35
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 36
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 38,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 43
          }
        }
      },
      "span": {
        "start": 25,
        "end": 44
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 46,
                            "end": 48
                          }
                        },
                        "op": "Less",
                        "right": {
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
                                      "start": 52,
                                      "end": 53
                                    }
                                  }
                                },
                                "span": {
                                  "start": 52,
                                  "end": 53
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 51,
                            "end": 54
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 46,
                      "end": 54
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 55
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 57,
                  "end": 62
                }
              }
            }
          },
          "span": {
            "start": 45,
            "end": 62
          }
        }
      },
      "span": {
        "start": 45,
        "end": 63
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
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
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 66,
                                      "end": 67
                                    }
                                  }
                                },
                                "span": {
                                  "start": 66,
                                  "end": 67
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 65,
                            "end": 68
                          }
                        },
                        "op": "Identical",
                        "right": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 74,
                                      "end": 75
                                    }
                                  }
                                },
                                "span": {
                                  "start": 74,
                                  "end": 75
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 3
                                    },
                                    "span": {
                                      "start": 77,
                                      "end": 78
                                    }
                                  }
                                },
                                "span": {
                                  "start": 77,
                                  "end": 78
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 73,
                            "end": 79
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 65,
                      "end": 79
                    }
                  }
                },
                "span": {
                  "start": 64,
                  "end": 80
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 82,
                  "end": 87
                }
              }
            }
          },
          "span": {
            "start": 64,
            "end": 87
          }
        }
      },
      "span": {
        "start": 64,
        "end": 88
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 90,
                            "end": 91
                          }
                        },
                        "op": "Less",
                        "right": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 94,
                            "end": 96
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 90,
                      "end": 96
                    }
                  }
                },
                "span": {
                  "start": 89,
                  "end": 97
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 99,
                  "end": 104
                }
              }
            }
          },
          "span": {
            "start": 89,
            "end": 104
          }
        }
      },
      "span": {
        "start": 89,
        "end": 105
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 107,
                            "end": 109
                          }
                        },
                        "op": "Greater",
                        "right": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 112,
                            "end": 115
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 107,
                      "end": 115
                    }
                  }
                },
                "span": {
                  "start": 106,
                  "end": 116
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 118,
                  "end": 123
                }
              }
            }
          },
          "span": {
            "start": 106,
            "end": 123
          }
        }
      },
      "span": {
        "start": 106,
        "end": 124
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 126,
                            "end": 128
                          }
                        },
                        "op": "Equal",
                        "right": {
                          "kind": "Null",
                          "span": {
                            "start": 132,
                            "end": 136
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 126,
                      "end": 136
                    }
                  }
                },
                "span": {
                  "start": 125,
                  "end": 137
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 139,
                  "end": 144
                }
              }
            }
          },
          "span": {
            "start": 125,
            "end": 144
          }
        }
      },
      "span": {
        "start": 125,
        "end": 145
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 147,
                            "end": 149
                          }
                        },
                        "op": "Spaceship",
                        "right": {
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
                                      "start": 155,
                                      "end": 156
                                    }
                                  }
                                },
                                "span": {
                                  "start": 155,
                                  "end": 156
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 154,
                            "end": 157
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 147,
                      "end": 157
                    }
                  }
                },
                "span": {
                  "start": 146,
                  "end": 158
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 160,
                  "end": 165
                }
              }
            }
          },
          "span": {
            "start": 146,
            "end": 165
          }
        }
      },
      "span": {
        "start": 146,
        "end": 166
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 167,
                        "end": 169
                      }
                    },
                    "op": "Equal",
                    "right": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 173,
                        "end": 175
                      }
                    }
                  }
                },
                "span": {
                  "start": 167,
                  "end": 175
                }
              },
              "op": "BooleanAnd",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 185,
                              "end": 186
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 189,
                              "end": 190
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 185,
                        "end": 190
                      }
                    }
                  ]
                },
                "span": {
                  "start": 179,
                  "end": 191
                }
              }
            }
          },
          "span": {
            "start": 167,
            "end": 191
          }
        }
      },
      "span": {
        "start": 167,
        "end": 192
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 192
  }
}

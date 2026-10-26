===source===
<?php
1 < 2 && isset(1 + 1);
"a" . "b" === "ab" and isset(1 + 1);
PHP_EOL === 1 || isset(1 + 1);
1 > 2 || 3 > 4 || isset(1 + 1);
class C {
    function f() {
        __CLASS__ && isset(1 + 1);
    }
}
function f() {
    __CLASS__ || isset(1 + 1);
}
===errors===
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===php_error===
PHP Fatal error:  Cannot use isset() on the result of an expression (you can use "null !== expression" instead) in Standard input code on line 2
===ast===
{
  "stmts": [
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
                        "Int": 1
                      },
                      "span": {
                        "start": 6,
                        "end": 7
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 10,
                        "end": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
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
                              "start": 21,
                              "end": 22
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 25,
                              "end": 26
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 26
                      }
                    }
                  ]
                },
                "span": {
                  "start": 15,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
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
                        "Binary": {
                          "left": {
                            "kind": {
                              "String": "a"
                            },
                            "span": {
                              "start": 29,
                              "end": 32
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 35,
                              "end": 38
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 38
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "String": "ab"
                      },
                      "span": {
                        "start": 43,
                        "end": 47
                      }
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 47
                }
              },
              "op": "LogicalAnd",
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
                              "start": 58,
                              "end": 59
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 62,
                              "end": 63
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 63
                      }
                    }
                  ]
                },
                "span": {
                  "start": 52,
                  "end": 64
                }
              }
            }
          },
          "span": {
            "start": 29,
            "end": 64
          }
        }
      },
      "span": {
        "start": 29,
        "end": 65
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
                        "Name": {
                          "parts": [
                            "PHP_EOL"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 66,
                            "end": 73
                          }
                        }
                      },
                      "span": {
                        "start": 66,
                        "end": 73
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 78,
                        "end": 79
                      }
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 79
                }
              },
              "op": "BooleanOr",
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
                              "start": 89,
                              "end": 90
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 93,
                              "end": 94
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 89,
                        "end": 94
                      }
                    }
                  ]
                },
                "span": {
                  "start": 83,
                  "end": 95
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 95
          }
        }
      },
      "span": {
        "start": 66,
        "end": 96
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
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 97,
                              "end": 98
                            }
                          },
                          "op": "Greater",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 101,
                              "end": 102
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 97,
                        "end": 102
                      }
                    },
                    "op": "BooleanOr",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 106,
                              "end": 107
                            }
                          },
                          "op": "Greater",
                          "right": {
                            "kind": {
                              "Int": 4
                            },
                            "span": {
                              "start": 110,
                              "end": 111
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 106,
                        "end": 111
                      }
                    }
                  }
                },
                "span": {
                  "start": 97,
                  "end": 111
                }
              },
              "op": "BooleanOr",
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
                              "start": 121,
                              "end": 122
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 125,
                              "end": 126
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 121,
                        "end": 126
                      }
                    }
                  ]
                },
                "span": {
                  "start": 115,
                  "end": 127
                }
              }
            }
          },
          "span": {
            "start": 97,
            "end": 127
          }
        }
      },
      "span": {
        "start": 97,
        "end": 128
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 135,
              "end": 136
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 152,
                      "end": 153
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "MagicConst": "Class"
                                },
                                "span": {
                                  "start": 166,
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
                            "start": 166,
                            "end": 191
                          }
                        }
                      },
                      "span": {
                        "start": 166,
                        "end": 192
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 143,
                "end": 198
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 129,
        "end": 200
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 210,
              "end": 211
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "MagicConst": "Class"
                        },
                        "span": {
                          "start": 220,
                          "end": 229
                        }
                      },
                      "op": "BooleanOr",
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
                                      "start": 239,
                                      "end": 240
                                    }
                                  },
                                  "op": "Add",
                                  "right": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 243,
                                      "end": 244
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 239,
                                "end": 244
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 233,
                          "end": 245
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 220,
                    "end": 245
                  }
                }
              },
              "span": {
                "start": 220,
                "end": 246
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 201,
        "end": 248
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 248
  }
}

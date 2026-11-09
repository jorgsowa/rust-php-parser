===description===
From PHP 8.4 the lexer reads `public(set)` as one token, also after `::`; spacing or `->` keeps it a method call.
===source===
<?php
C::public(set);
$c::PROTECTED(Set);
"{$c::private(set)}";
C::public( set );
C:: public (set);
C::public(set: 1);
$o->public(set);
$o?->private(set);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
===errors >=8.4===
unexpected token "public(set)"
unexpected token "protected(set)"
unexpected token "private(set)"
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 7
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "public(set)" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 9,
                  "end": 15
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 16,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 19
                      }
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "method": {
                "kind": {
                  "Identifier": "PROTECTED"
                },
                "span": {
                  "start": 26,
                  "end": 35
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 36,
                            "end": 39
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 39
                      }
                    }
                  },
                  "span": {
                    "start": 36,
                    "end": 39
                  }
                }
              ]
            }
          },
          "span": {
            "start": 22,
            "end": 40
          }
        }
      },
      "span": {
        "start": 22,
        "end": 41
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "StaticMethodCall": {
                      "class": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 44,
                          "end": 46
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "private"
                        },
                        "span": {
                          "start": 48,
                          "end": 55
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "set"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 56,
                                    "end": 59
                                  }
                                }
                              },
                              "span": {
                                "start": 56,
                                "end": 59
                              }
                            }
                          },
                          "span": {
                            "start": 56,
                            "end": 59
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 44,
                    "end": 60
                  }
                }
              }
            ]
          },
          "span": {
            "start": 42,
            "end": 62
          }
        }
      },
      "span": {
        "start": 42,
        "end": 63
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  }
                },
                "span": {
                  "start": 64,
                  "end": 65
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 67,
                  "end": 73
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 75,
                            "end": 78
                          }
                        }
                      },
                      "span": {
                        "start": 75,
                        "end": 78
                      }
                    }
                  },
                  "span": {
                    "start": 75,
                    "end": 78
                  }
                }
              ]
            }
          },
          "span": {
            "start": 64,
            "end": 80
          }
        }
      },
      "span": {
        "start": 64,
        "end": 81
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 82,
                      "end": 83
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 83
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 86,
                  "end": 92
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 94,
                            "end": 97
                          }
                        }
                      },
                      "span": {
                        "start": 94,
                        "end": 97
                      }
                    }
                  },
                  "span": {
                    "start": 94,
                    "end": 97
                  }
                }
              ]
            }
          },
          "span": {
            "start": 82,
            "end": 98
          }
        }
      },
      "span": {
        "start": 82,
        "end": 99
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "C"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 100,
                      "end": 101
                    }
                  }
                },
                "span": {
                  "start": 100,
                  "end": 101
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 103,
                  "end": 109
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "set"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 110,
                      "end": 113
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 115,
                        "end": 116
                      }
                    }
                  },
                  "span": {
                    "start": 110,
                    "end": 116
                  }
                }
              ]
            }
          },
          "span": {
            "start": 100,
            "end": 117
          }
        }
      },
      "span": {
        "start": 100,
        "end": 118
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 119,
                  "end": 121
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 123,
                  "end": 129
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 130,
                            "end": 133
                          }
                        }
                      },
                      "span": {
                        "start": 130,
                        "end": 133
                      }
                    }
                  },
                  "span": {
                    "start": 130,
                    "end": 133
                  }
                }
              ]
            }
          },
          "span": {
            "start": 119,
            "end": 134
          }
        }
      },
      "span": {
        "start": 119,
        "end": 135
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafeMethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 136,
                  "end": 138
                }
              },
              "method": {
                "kind": {
                  "Identifier": "private"
                },
                "span": {
                  "start": 141,
                  "end": 148
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "set"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 149,
                            "end": 152
                          }
                        }
                      },
                      "span": {
                        "start": 149,
                        "end": 152
                      }
                    }
                  },
                  "span": {
                    "start": 149,
                    "end": 152
                  }
                }
              ]
            }
          },
          "span": {
            "start": 136,
            "end": 153
          }
        }
      },
      "span": {
        "start": 136,
        "end": 154
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 154
  }
}

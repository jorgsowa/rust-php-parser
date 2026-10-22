===source===
<?php
isset($a{0}, $a[0]{1}, $a{0}[1], $a->b{0}, $a{0}->b, ($a){0});
empty($a{0}{1});
isset($a[$b{0}]);
echo $c{0};
===errors 8.0-8.3===
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
===errors >=8.4===
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
===php_error 8.0-8.3===
PHP Fatal error:  Array and string offset access syntax with curly braces is no longer supported in Standard input code on line 4
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 2
===ast >=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 15,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 17
                }
              },
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 19,
                              "end": 21
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 22,
                              "end": 23
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 24
                      }
                    },
                    "index": {
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
                  "start": 19,
                  "end": 27
                }
              },
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 29,
                              "end": 31
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 32,
                              "end": 33
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 34
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 35,
                        "end": 36
                      }
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 37
                }
              },
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 39,
                              "end": 41
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 43,
                              "end": 44
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 39,
                        "end": 44
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 45,
                        "end": 46
                      }
                    }
                  }
                },
                "span": {
                  "start": 39,
                  "end": 47
                }
              },
              {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 49,
                              "end": 51
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 52,
                              "end": 53
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 54
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 56,
                        "end": 57
                      }
                    }
                  }
                },
                "span": {
                  "start": 49,
                  "end": 57
                }
              },
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 60,
                            "end": 62
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 63
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 64,
                        "end": 65
                      }
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 66
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 67
          }
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Empty": {
              "kind": {
                "ArrayAccess": {
                  "array": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 75,
                            "end": 77
                          }
                        },
                        "index": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 78,
                            "end": 79
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 75,
                      "end": 80
                    }
                  },
                  "index": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 81,
                      "end": 82
                    }
                  }
                }
              },
              "span": {
                "start": 75,
                "end": 83
              }
            }
          },
          "span": {
            "start": 69,
            "end": 84
          }
        }
      },
      "span": {
        "start": 69,
        "end": 85
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 92,
                        "end": 94
                      }
                    },
                    "index": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 95,
                              "end": 97
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 98,
                              "end": 99
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 100
                      }
                    }
                  }
                },
                "span": {
                  "start": 92,
                  "end": 101
                }
              }
            ]
          },
          "span": {
            "start": 86,
            "end": 102
          }
        }
      },
      "span": {
        "start": 86,
        "end": 103
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "c"
                  },
                  "span": {
                    "start": 109,
                    "end": 111
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 112,
                    "end": 113
                  }
                }
              }
            },
            "span": {
              "start": 109,
              "end": 114
            }
          }
        ]
      },
      "span": {
        "start": 104,
        "end": 115
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115
  }
}

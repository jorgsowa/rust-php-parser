===source===
<?php
(1 |> f(...))->p ??= 99;
(1 |> f(...))[0] = 1;
(1 |> f(...))->p++;
unset((1 |> f(...))->p);
$x = &(1 |> f(...))->p;
foreach ($a as (1 |> f(...))->p) {}
===errors <=8.0===
'pipe operator (|>)' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
Cannot use temporary expression in write context
===errors 8.1-8.4===
'pipe operator (|>)' requires PHP 8.5 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
Cannot use temporary expression in write context
'pipe operator (|>)' requires PHP 8.5 or higher
Cannot use temporary expression in write context
===errors 8.5===
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '>' in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ">" in Standard input code on line 2
===php_error 8.5===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 7,
                                  "end": 8
                                }
                              },
                              "op": "Pipe",
                              "right": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "Function": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "f"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 12,
                                              "end": 13
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 12,
                                          "end": 13
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 12,
                                  "end": 18
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 18
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 19
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 21,
                        "end": 22
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "Int": 99
                },
                "span": {
                  "start": 27,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30
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
                        "Parenthesized": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 32,
                                  "end": 33
                                }
                              },
                              "op": "Pipe",
                              "right": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "Function": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "f"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 37,
                                              "end": 38
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 37,
                                          "end": 38
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 37,
                                  "end": 43
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 32,
                            "end": 43
                          }
                        }
                      },
                      "span": {
                        "start": 31,
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
                  "start": 31,
                  "end": 47
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 50,
                  "end": 51
                }
              }
            }
          },
          "span": {
            "start": 31,
            "end": 51
          }
        }
      },
      "span": {
        "start": 31,
        "end": 52
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 54,
                                  "end": 55
                                }
                              },
                              "op": "Pipe",
                              "right": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "Function": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "f"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 59,
                                              "end": 60
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 59,
                                          "end": 60
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 59,
                                  "end": 65
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 54,
                            "end": 65
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 66
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 68,
                        "end": 69
                      }
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 69
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 53,
            "end": 71
          }
        }
      },
      "span": {
        "start": 53,
        "end": 72
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 80,
                              "end": 81
                            }
                          },
                          "op": "Pipe",
                          "right": {
                            "kind": {
                              "CallableCreate": {
                                "kind": {
                                  "Function": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "f"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 85,
                                          "end": 86
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 85,
                                      "end": 86
                                    }
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 85,
                              "end": 91
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 80,
                        "end": 91
                      }
                    }
                  },
                  "span": {
                    "start": 79,
                    "end": 92
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "p"
                  },
                  "span": {
                    "start": 94,
                    "end": 95
                  }
                }
              }
            },
            "span": {
              "start": 79,
              "end": 95
            }
          }
        ]
      },
      "span": {
        "start": 73,
        "end": 97
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
                  "start": 98,
                  "end": 100
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
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 105,
                                  "end": 106
                                }
                              },
                              "op": "Pipe",
                              "right": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "Function": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "f"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 110,
                                              "end": 111
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 110,
                                          "end": 111
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 110,
                                  "end": 116
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 105,
                            "end": 116
                          }
                        }
                      },
                      "span": {
                        "start": 104,
                        "end": 117
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 119,
                        "end": 120
                      }
                    }
                  }
                },
                "span": {
                  "start": 104,
                  "end": 120
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 98,
            "end": 120
          }
        }
      },
      "span": {
        "start": 98,
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
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 138,
                              "end": 139
                            }
                          },
                          "op": "Pipe",
                          "right": {
                            "kind": {
                              "CallableCreate": {
                                "kind": {
                                  "Function": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "f"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 143,
                                          "end": 144
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 143,
                                      "end": 144
                                    }
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 143,
                              "end": 149
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 138,
                        "end": 149
                      }
                    }
                  },
                  "span": {
                    "start": 137,
                    "end": 150
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "p"
                  },
                  "span": {
                    "start": 152,
                    "end": 153
                  }
                }
              }
            },
            "span": {
              "start": 137,
              "end": 153
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 155,
              "end": 157
            }
          }
        }
      },
      "span": {
        "start": 122,
        "end": 157
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 157
  }
}

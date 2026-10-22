===source===
<?php
$a = &f();
$a = &$o->m();
$a = f(...);
$a = $o->m(...);
$a = A::m(...);
foo(f(...));
[&$x] = f(...);
[$x, &$y] = $o->m(...);
function &g() { return f(...); }
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callable syntax' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 4
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 4
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
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
                            "start": 12,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 15
                }
              },
              "by_ref": true
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
                  "Variable": "a"
                },
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "o"
                      },
                      "span": {
                        "start": 23,
                        "end": 25
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "m"
                      },
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 23,
                  "end": 30
                }
              },
              "by_ref": true
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
                  "Variable": "a"
                },
                "span": {
                  "start": 32,
                  "end": 34
                }
              },
              "op": "Assign",
              "value": {
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
        "start": 32,
        "end": 44
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
                  "start": 45,
                  "end": 47
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Method": {
                        "object": {
                          "kind": {
                            "Variable": "o"
                          },
                          "span": {
                            "start": 50,
                            "end": 52
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 54,
                            "end": 55
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 50,
                  "end": 60
                }
              }
            }
          },
          "span": {
            "start": 45,
            "end": 60
          }
        }
      },
      "span": {
        "start": 45,
        "end": 61
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
                  "start": 62,
                  "end": 64
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "StaticMethod": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 67,
                                "end": 68
                              }
                            }
                          },
                          "span": {
                            "start": 67,
                            "end": 68
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 70,
                            "end": 71
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 67,
                  "end": 76
                }
              }
            }
          },
          "span": {
            "start": 62,
            "end": 76
          }
        }
      },
      "span": {
        "start": 62,
        "end": 77
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
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 78,
                      "end": 81
                    }
                  }
                },
                "span": {
                  "start": 78,
                  "end": 81
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
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
                                    "start": 82,
                                    "end": 83
                                  }
                                }
                              },
                              "span": {
                                "start": 82,
                                "end": 83
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 82,
                        "end": 88
                      }
                    }
                  },
                  "span": {
                    "start": 82,
                    "end": 88
                  }
                }
              ]
            }
          },
          "span": {
            "start": 78,
            "end": 89
          }
        }
      },
      "span": {
        "start": 78,
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 93,
                            "end": 95
                          }
                        }
                      },
                      "span": {
                        "start": 92,
                        "end": 95
                      }
                    }
                  ]
                },
                "span": {
                  "start": 91,
                  "end": 96
                }
              },
              "op": "Assign",
              "value": {
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
                              "start": 99,
                              "end": 100
                            }
                          }
                        },
                        "span": {
                          "start": 99,
                          "end": 100
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 99,
                  "end": 105
                }
              }
            }
          },
          "span": {
            "start": 91,
            "end": 105
          }
        }
      },
      "span": {
        "start": 91,
        "end": 106
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
                            "Variable": "x"
                          },
                          "span": {
                            "start": 108,
                            "end": 110
                          }
                        }
                      },
                      "span": {
                        "start": 108,
                        "end": 110
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "y"
                          },
                          "span": {
                            "start": 113,
                            "end": 115
                          }
                        }
                      },
                      "span": {
                        "start": 112,
                        "end": 115
                      }
                    }
                  ]
                },
                "span": {
                  "start": 107,
                  "end": 116
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Method": {
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
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 123,
                            "end": 124
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 119,
                  "end": 129
                }
              }
            }
          },
          "span": {
            "start": 107,
            "end": 129
          }
        }
      },
      "span": {
        "start": 107,
        "end": 130
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 141,
              "end": 142
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
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
                                "start": 154,
                                "end": 155
                              }
                            }
                          },
                          "span": {
                            "start": 154,
                            "end": 155
                          }
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 154,
                    "end": 160
                  }
                }
              },
              "span": {
                "start": 147,
                "end": 161
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 131,
        "end": 163
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163
  }
}

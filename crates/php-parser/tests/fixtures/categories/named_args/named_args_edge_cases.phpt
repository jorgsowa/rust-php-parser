===source===
<?php
foo(a: 1, b: 2, c: 3);
bar(...$args, extra: true);
baz(1, 2, name: 'test');
array_map(callback: fn($x) => $x * 2, array: $arr);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named argument after argument unpacking' requires PHP 8.1 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
===errors 8.0===
'named argument after argument unpacking' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 2
===php_error 8.0===
PHP Fatal error:  Cannot combine named arguments and argument unpacking in Standard input code on line 3
===ast===
{
  "stmts": [
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
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "a"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 11
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 14
                  }
                },
                {
                  "name": {
                    "parts": [
                      "b"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 20
                  }
                },
                {
                  "name": {
                    "parts": [
                      "c"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 22,
                      "end": 23
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 25,
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
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "bar"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 29,
                      "end": 32
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 32
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "args"
                      },
                      "span": {
                        "start": 36,
                        "end": 41
                      }
                    }
                  },
                  "span": {
                    "start": 33,
                    "end": 41
                  }
                },
                {
                  "name": {
                    "parts": [
                      "extra"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 43,
                      "end": 48
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 50,
                        "end": 54
                      }
                    }
                  },
                  "span": {
                    "start": 43,
                    "end": 54
                  }
                }
              ]
            }
          },
          "span": {
            "start": 29,
            "end": 55
          }
        }
      },
      "span": {
        "start": 29,
        "end": 56
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
                      "baz"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 57,
                      "end": 60
                    }
                  }
                },
                "span": {
                  "start": 57,
                  "end": 60
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 61,
                        "end": 62
                      }
                    }
                  },
                  "span": {
                    "start": 61,
                    "end": 62
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 2
                      },
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
                {
                  "name": {
                    "parts": [
                      "name"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 67,
                      "end": 71
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "String": "test"
                      },
                      "span": {
                        "start": 73,
                        "end": 79
                      }
                    }
                  },
                  "span": {
                    "start": 67,
                    "end": 79
                  }
                }
              ]
            }
          },
          "span": {
            "start": 57,
            "end": 80
          }
        }
      },
      "span": {
        "start": 57,
        "end": 81
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
                      "array_map"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 82,
                      "end": 91
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 91
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "callback"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 92,
                      "end": 100
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrowFunction": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": {
                                "name": "x",
                                "span": {
                                  "start": 105,
                                  "end": 107
                                }
                              },
                              "type_hint": null,
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "attributes": [],
                              "span": {
                                "start": 105,
                                "end": 107
                              }
                            }
                          ],
                          "return_type": null,
                          "body": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 112,
                                    "end": 114
                                  }
                                },
                                "op": "Mul",
                                "right": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 117,
                                    "end": 118
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 112,
                              "end": 118
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 102,
                        "end": 118
                      }
                    }
                  },
                  "span": {
                    "start": 92,
                    "end": 118
                  }
                },
                {
                  "name": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 120,
                      "end": 125
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "arr"
                      },
                      "span": {
                        "start": 127,
                        "end": 131
                      }
                    }
                  },
                  "span": {
                    "start": 120,
                    "end": 131
                  }
                }
              ]
            }
          },
          "span": {
            "start": 82,
            "end": 132
          }
        }
      },
      "span": {
        "start": 82,
        "end": 133
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}

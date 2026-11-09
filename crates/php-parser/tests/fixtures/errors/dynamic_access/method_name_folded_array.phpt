===source===
<?php
$o->{[]}();
$o->{[1, 2]}();
$o->{[[]]}();
$o->{[...[1]]}();
$o->{[] + [1]}();
A::{['a' => 1]}();
$o->{[1.5 => 1]}();
$o->{[$a]}();
$o->{[] . 'a'}();
===errors <=8.0===
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
===errors >=8.1===
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
===php_error===
PHP Fatal error:  Method name must be a string in Standard input code on line 2
===ast===
{
  "stmts": [
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
                  "start": 6,
                  "end": 8
                }
              },
              "method": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 11,
                  "end": 13
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
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
                  "start": 18,
                  "end": 20
                }
              },
              "method": {
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
                            "start": 24,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 27,
                            "end": 28
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 28
                      }
                    }
                  ]
                },
                "span": {
                  "start": 23,
                  "end": 29
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 18,
            "end": 32
          }
        }
      },
      "span": {
        "start": 18,
        "end": 33
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
                  "start": 34,
                  "end": 36
                }
              },
              "method": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 40,
                            "end": 42
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 42
                      }
                    }
                  ]
                },
                "span": {
                  "start": 39,
                  "end": 43
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 34,
            "end": 46
          }
        }
      },
      "span": {
        "start": 34,
        "end": 47
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
                  "start": 48,
                  "end": 50
                }
              },
              "method": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
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
                                      "start": 58,
                                      "end": 59
                                    }
                                  }
                                },
                                "span": {
                                  "start": 58,
                                  "end": 59
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 57,
                            "end": 60
                          }
                        }
                      },
                      "span": {
                        "start": 54,
                        "end": 60
                      }
                    }
                  ]
                },
                "span": {
                  "start": 53,
                  "end": 61
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 48,
            "end": 64
          }
        }
      },
      "span": {
        "start": 48,
        "end": 65
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
                  "start": 66,
                  "end": 68
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 71,
                        "end": 73
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
                                  "Int": 1
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
                        "start": 76,
                        "end": 79
                      }
                    }
                  }
                },
                "span": {
                  "start": 71,
                  "end": 79
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 66,
            "end": 82
          }
        }
      },
      "span": {
        "start": 66,
        "end": 83
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCallDynamic": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 84,
                      "end": 85
                    }
                  }
                },
                "span": {
                  "start": 84,
                  "end": 85
                }
              },
              "method": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "a"
                        },
                        "span": {
                          "start": 89,
                          "end": 92
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 96,
                            "end": 97
                          }
                        }
                      },
                      "span": {
                        "start": 89,
                        "end": 97
                      }
                    }
                  ]
                },
                "span": {
                  "start": 88,
                  "end": 98
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 84,
            "end": 101
          }
        }
      },
      "span": {
        "start": 84,
        "end": 102
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
                  "start": 103,
                  "end": 105
                }
              },
              "method": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "Float": 1.5
                        },
                        "span": {
                          "start": 109,
                          "end": 112
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 116,
                            "end": 117
                          }
                        }
                      },
                      "span": {
                        "start": 109,
                        "end": 117
                      }
                    }
                  ]
                },
                "span": {
                  "start": 108,
                  "end": 118
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 103,
            "end": 121
          }
        }
      },
      "span": {
        "start": 103,
        "end": 122
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
                  "start": 123,
                  "end": 125
                }
              },
              "method": {
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
                            "start": 129,
                            "end": 131
                          }
                        }
                      },
                      "span": {
                        "start": 129,
                        "end": 131
                      }
                    }
                  ]
                },
                "span": {
                  "start": 128,
                  "end": 132
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 123,
            "end": 135
          }
        }
      },
      "span": {
        "start": 123,
        "end": 136
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
                  "start": 137,
                  "end": 139
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 142,
                        "end": 144
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 147,
                        "end": 150
                      }
                    }
                  }
                },
                "span": {
                  "start": 142,
                  "end": 150
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 137,
            "end": 153
          }
        }
      },
      "span": {
        "start": 137,
        "end": 154
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 154
  }
}

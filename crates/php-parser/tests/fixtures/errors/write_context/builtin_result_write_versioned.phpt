===source===
<?php
is_scalar($a)[0] = 1;
is_long($a)[0] = 1;
sprintf('%s-%d', $a, $b)[0] = 1;
printf('a')[0] = 1;
str_contains($a, $b)[0] = 1;
===errors <=7.4===
Cannot use result of built-in function in write context
===errors 8.0-8.3===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===errors 8.4-8.5===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===errors >=8.6===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===php_error <=7.4===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 2
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "is_scalar"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 6,
                                  "end": 15
                                }
                              }
                            },
                            "span": {
                              "start": 6,
                              "end": 15
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 16,
                                    "end": 18
                                  }
                                }
                              },
                              "span": {
                                "start": 16,
                                "end": 18
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 19
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "op": "Assign",
              "value": {
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
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
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
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "is_long"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 28,
                                  "end": 35
                                }
                              }
                            },
                            "span": {
                              "start": 28,
                              "end": 35
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 36,
                                    "end": 38
                                  }
                                }
                              },
                              "span": {
                                "start": 36,
                                "end": 38
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 39
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 40,
                        "end": 41
                      }
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 42
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 45,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 46
          }
        }
      },
      "span": {
        "start": 28,
        "end": 47
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
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "sprintf"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 48,
                                  "end": 55
                                }
                              }
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
                                    "String": "%s-%d"
                                  },
                                  "span": {
                                    "start": 56,
                                    "end": 63
                                  }
                                }
                              },
                              "span": {
                                "start": 56,
                                "end": 63
                              }
                            },
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 65,
                                    "end": 67
                                  }
                                }
                              },
                              "span": {
                                "start": 65,
                                "end": 67
                              }
                            },
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 69,
                                    "end": 71
                                  }
                                }
                              },
                              "span": {
                                "start": 69,
                                "end": 71
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 48,
                        "end": 72
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 73,
                        "end": 74
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 75
                }
              },
              "op": "Assign",
              "value": {
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
            "start": 48,
            "end": 79
          }
        }
      },
      "span": {
        "start": 48,
        "end": 80
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
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "printf"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 81,
                                  "end": 87
                                }
                              }
                            },
                            "span": {
                              "start": 81,
                              "end": 87
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "String": "a"
                                  },
                                  "span": {
                                    "start": 88,
                                    "end": 91
                                  }
                                }
                              },
                              "span": {
                                "start": 88,
                                "end": 91
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 81,
                        "end": 92
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 93,
                        "end": 94
                      }
                    }
                  }
                },
                "span": {
                  "start": 81,
                  "end": 95
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 98,
                  "end": 99
                }
              }
            }
          },
          "span": {
            "start": 81,
            "end": 99
          }
        }
      },
      "span": {
        "start": 81,
        "end": 100
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
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "str_contains"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 101,
                                  "end": 113
                                }
                              }
                            },
                            "span": {
                              "start": 101,
                              "end": 113
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 114,
                                    "end": 116
                                  }
                                }
                              },
                              "span": {
                                "start": 114,
                                "end": 116
                              }
                            },
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 118,
                                    "end": 120
                                  }
                                }
                              },
                              "span": {
                                "start": 118,
                                "end": 120
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 101,
                        "end": 121
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 122,
                        "end": 123
                      }
                    }
                  }
                },
                "span": {
                  "start": 101,
                  "end": 124
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 127,
                  "end": 128
                }
              }
            }
          },
          "span": {
            "start": 101,
            "end": 128
          }
        }
      },
      "span": {
        "start": 101,
        "end": 129
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 129
  }
}

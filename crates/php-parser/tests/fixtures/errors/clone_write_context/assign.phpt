===source===
<?php
(clone $a)->b = 1;
(clone $a)[0] = 1;
(clone $a)->b[0] = 1;
(clone $a)[0][1] .= 1;
===errors===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===php_error===
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Clone": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 13,
                                "end": 15
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
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 22,
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
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Clone": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 32,
                                "end": 34
                              }
                            }
                          },
                          "span": {
                            "start": 26,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 35
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 36,
                        "end": 37
                      }
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 38
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 41,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 42
          }
        }
      },
      "span": {
        "start": 25,
        "end": 43
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
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Clone": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 51,
                                      "end": 53
                                    }
                                  }
                                },
                                "span": {
                                  "start": 45,
                                  "end": 53
                                }
                              }
                            },
                            "span": {
                              "start": 44,
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
                        "start": 44,
                        "end": 57
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 58,
                        "end": 59
                      }
                    }
                  }
                },
                "span": {
                  "start": 44,
                  "end": 60
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 63,
                  "end": 64
                }
              }
            }
          },
          "span": {
            "start": 44,
            "end": 64
          }
        }
      },
      "span": {
        "start": 44,
        "end": 65
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
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Clone": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 73,
                                      "end": 75
                                    }
                                  }
                                },
                                "span": {
                                  "start": 67,
                                  "end": 75
                                }
                              }
                            },
                            "span": {
                              "start": 66,
                              "end": 76
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 77,
                              "end": 78
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 66,
                        "end": 79
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 80,
                        "end": 81
                      }
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 82
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 86,
                  "end": 87
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 87
          }
        }
      },
      "span": {
        "start": 66,
        "end": 88
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88
  }
}

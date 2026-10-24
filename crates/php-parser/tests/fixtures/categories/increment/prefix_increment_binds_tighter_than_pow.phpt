===source===
<?php
$a = --$b ** 2;
$c = ++$d->e ** 2;
$f = -++$g[0] ** 2;
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "PreDecrement",
                          "operand": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 13,
                              "end": 15
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 15
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 20
                }
              }
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
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "PreIncrement",
                          "operand": {
                            "kind": {
                              "PropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Variable": "d"
                                  },
                                  "span": {
                                    "start": 29,
                                    "end": 31
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "e"
                                  },
                                  "span": {
                                    "start": 33,
                                    "end": 34
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 29,
                              "end": 34
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 34
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 38,
                        "end": 39
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 39
          }
        }
      },
      "span": {
        "start": 22,
        "end": 40
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 41,
                  "end": 43
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "UnaryPrefix": {
                                "op": "PreIncrement",
                                "operand": {
                                  "kind": {
                                    "ArrayAccess": {
                                      "array": {
                                        "kind": {
                                          "Variable": "g"
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
                                }
                              }
                            },
                            "span": {
                              "start": 47,
                              "end": 54
                            }
                          },
                          "op": "Pow",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 58,
                              "end": 59
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 59
                      }
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 59
          }
        }
      },
      "span": {
        "start": 41,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}

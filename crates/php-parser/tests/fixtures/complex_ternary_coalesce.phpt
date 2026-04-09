===source===
<?php
$a = $x ?: $y ?? $z;
$b = $x ?? $y ?: $z;
$c = $a ? $b ? $c : $d : $e;
$d = ($a ?? $b) ? ($c ?: $d) : ($e ?? $f);
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
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 11,
                        "end": 13,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "NullCoalesce": {
                          "left": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 17,
                              "end": 19,
                              "start_line": 2,
                              "start_col": 11
                            }
                          },
                          "right": {
                            "kind": {
                              "Variable": "z"
                            },
                            "span": {
                              "start": 23,
                              "end": 25,
                              "start_line": 2,
                              "start_col": 17
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 25,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 27,
                  "end": 29,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "NullCoalesce": {
                          "left": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 32,
                              "end": 34,
                              "start_line": 3,
                              "start_col": 5
                            }
                          },
                          "right": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 38,
                              "end": 40,
                              "start_line": 3,
                              "start_col": 11
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 40,
                        "start_line": 3,
                        "start_col": 5
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "Variable": "z"
                      },
                      "span": {
                        "start": 44,
                        "end": 46,
                        "start_line": 3,
                        "start_col": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 46,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 46,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 27,
        "end": 48,
        "start_line": 3,
        "start_col": 0
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
                  "start": 48,
                  "end": 50,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 53,
                        "end": 55,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Ternary": {
                          "condition": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 58,
                              "end": 60,
                              "start_line": 4,
                              "start_col": 10
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 63,
                              "end": 65,
                              "start_line": 4,
                              "start_col": 15
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "Variable": "d"
                            },
                            "span": {
                              "start": 68,
                              "end": 70,
                              "start_line": 4,
                              "start_col": 20
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 70,
                        "start_line": 4,
                        "start_col": 10
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Variable": "e"
                      },
                      "span": {
                        "start": 73,
                        "end": 75,
                        "start_line": 4,
                        "start_col": 25
                      }
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 75,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 75,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 48,
        "end": 77,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 77,
                  "end": 79,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "NullCoalesce": {
                              "left": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 83,
                                  "end": 85,
                                  "start_line": 5,
                                  "start_col": 6
                                }
                              },
                              "right": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 89,
                                  "end": 91,
                                  "start_line": 5,
                                  "start_col": 12
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 83,
                            "end": 91,
                            "start_line": 5,
                            "start_col": 6
                          }
                        }
                      },
                      "span": {
                        "start": 82,
                        "end": 93,
                        "start_line": 5,
                        "start_col": 5
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Ternary": {
                              "condition": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 96,
                                  "end": 98,
                                  "start_line": 5,
                                  "start_col": 19
                                }
                              },
                              "then_expr": null,
                              "else_expr": {
                                "kind": {
                                  "Variable": "d"
                                },
                                "span": {
                                  "start": 102,
                                  "end": 104,
                                  "start_line": 5,
                                  "start_col": 25
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 96,
                            "end": 104,
                            "start_line": 5,
                            "start_col": 19
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 106,
                        "start_line": 5,
                        "start_col": 18
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "NullCoalesce": {
                              "left": {
                                "kind": {
                                  "Variable": "e"
                                },
                                "span": {
                                  "start": 109,
                                  "end": 111,
                                  "start_line": 5,
                                  "start_col": 32
                                }
                              },
                              "right": {
                                "kind": {
                                  "Variable": "f"
                                },
                                "span": {
                                  "start": 115,
                                  "end": 117,
                                  "start_line": 5,
                                  "start_col": 38
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 109,
                            "end": 117,
                            "start_line": 5,
                            "start_col": 32
                          }
                        }
                      },
                      "span": {
                        "start": 108,
                        "end": 118,
                        "start_line": 5,
                        "start_col": 31
                      }
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 118,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 77,
            "end": 118,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 77,
        "end": 119,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 119,
    "start_line": 1,
    "start_col": 0
  }
}

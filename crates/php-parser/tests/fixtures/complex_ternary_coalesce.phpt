===source===
<?php
$a = $x ?: $y ?? $z;
$b = $x ?? $y ?: $z;
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
                  "end": 8
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
                        "end": 13
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
                              "end": 19
                            }
                          },
                          "right": {
                            "kind": {
                              "Variable": "z"
                            },
                            "span": {
                              "start": 23,
                              "end": 25
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 25
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
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
                  "end": 29
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
                              "end": 34
                            }
                          },
                          "right": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 38,
                              "end": 40
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 40
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "Variable": "z"
                      },
                      "span": {
                        "start": 44,
                        "end": 46
                      }
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 46
          }
        }
      },
      "span": {
        "start": 27,
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
                  "Variable": "d"
                },
                "span": {
                  "start": 48,
                  "end": 50
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
                                  "start": 54,
                                  "end": 56
                                }
                              },
                              "right": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 60,
                                  "end": 62
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 54,
                            "end": 62
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 63
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
                                  "start": 67,
                                  "end": 69
                                }
                              },
                              "then_expr": null,
                              "else_expr": {
                                "kind": {
                                  "Variable": "d"
                                },
                                "span": {
                                  "start": 73,
                                  "end": 75
                                }
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
                                  "start": 80,
                                  "end": 82
                                }
                              },
                              "right": {
                                "kind": {
                                  "Variable": "f"
                                },
                                "span": {
                                  "start": 86,
                                  "end": 88
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 80,
                            "end": 88
                          }
                        }
                      },
                      "span": {
                        "start": 79,
                        "end": 89
                      }
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 89
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 89
          }
        }
      },
      "span": {
        "start": 48,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90
  }
}

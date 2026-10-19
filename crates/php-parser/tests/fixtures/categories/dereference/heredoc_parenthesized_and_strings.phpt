===source===
<?php
$a = (<<<X
a
X)->b;
$a = (<<<'X'
a
X)[0];
$a = "a$b"[0];
$a = "a"->b;
$a = "a$b"::C;
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Heredoc": {
                              "label": "X",
                              "parts": [
                                {
                                  "Literal": "a"
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 12,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 21
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
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
                  "start": 26,
                  "end": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Nowdoc": {
                              "label": "X",
                              "value": "a"
                            }
                          },
                          "span": {
                            "start": 32,
                            "end": 42
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 43
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 44,
                        "end": 45
                      }
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 46
          }
        }
      },
      "span": {
        "start": 26,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 48,
                  "end": 50
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "InterpolatedString": [
                          {
                            "Literal": "a"
                          },
                          {
                            "Expr": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 55,
                                "end": 57
                              }
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 53,
                        "end": 58
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 59,
                        "end": 60
                      }
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 61
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 61
          }
        }
      },
      "span": {
        "start": 48,
        "end": 62
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
                  "start": 63,
                  "end": 65
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 68,
                        "end": 71
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 73,
                        "end": 74
                      }
                    }
                  }
                },
                "span": {
                  "start": 68,
                  "end": 74
                }
              }
            }
          },
          "span": {
            "start": 63,
            "end": 74
          }
        }
      },
      "span": {
        "start": 63,
        "end": 75
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
                  "start": 76,
                  "end": 78
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "InterpolatedString": [
                          {
                            "Literal": "a"
                          },
                          {
                            "Expr": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 83,
                                "end": 85
                              }
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 81,
                        "end": 86
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "C"
                      },
                      "span": {
                        "start": 88,
                        "end": 89
                      }
                    }
                  }
                },
                "span": {
                  "start": 81,
                  "end": 89
                }
              }
            }
          },
          "span": {
            "start": 76,
            "end": 89
          }
        }
      },
      "span": {
        "start": 76,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90
  }
}

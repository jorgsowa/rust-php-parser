===source===
<?php
echo "${a} ${a[0]} ${a['k']} ${a[1 + 1]} ${'---'} ${"y$a$a"} ${$a} ${ a }";
echo <<<EOT
    ${a} ${"b$a"}
    EOT;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 12,
                      "end": 16
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 19,
                            "end": 20
                          }
                        },
                        "index": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 21,
                            "end": 22
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 17,
                      "end": 24
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 27,
                            "end": 28
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "k"
                          },
                          "span": {
                            "start": 29,
                            "end": 32
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 25,
                      "end": 34
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 37,
                            "end": 38
                          }
                        },
                        "index": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 39,
                                  "end": 40
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 43,
                                  "end": 44
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 39,
                            "end": 44
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 35,
                      "end": 46
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "String": "---"
                        },
                        "span": {
                          "start": 49,
                          "end": 54
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 55
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "InterpolatedString": [
                            {
                              "Literal": "y"
                            },
                            {
                              "Expr": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 60,
                                  "end": 62
                                }
                              }
                            },
                            {
                              "Expr": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 62,
                                  "end": 64
                                }
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 58,
                          "end": 65
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 66
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 69,
                          "end": 71
                        }
                      }
                    },
                    "span": {
                      "start": 67,
                      "end": 72
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "a"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 76,
                              "end": 77
                            }
                          }
                        },
                        "span": {
                          "start": 76,
                          "end": 77
                        }
                      }
                    },
                    "span": {
                      "start": 73,
                      "end": 79
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 80
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 81
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Heredoc": {
                "label": "EOT",
                "parts": [
                  {
                    "Expr": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 98,
                        "end": 102
                      }
                    }
                  },
                  {
                    "Literal": " "
                  },
                  {
                    "Expr": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "InterpolatedString": [
                              {
                                "Literal": "b"
                              },
                              {
                                "Expr": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 107,
                                    "end": 109
                                  }
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 105,
                            "end": 110
                          }
                        }
                      },
                      "span": {
                        "start": 103,
                        "end": 111
                      }
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 87,
              "end": 119
            }
          }
        ]
      },
      "span": {
        "start": 82,
        "end": 120
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 120
  }
}

===source===
<?php
$a = "x{$b[1]}y $c[0] $d->e";
$f = `ls {$g}`;
$h = <<<T
  {$i->j} $k
  T;
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
                  "InterpolatedString": [
                    {
                      "Literal": "x"
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 14,
                                "end": 16
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 17,
                                "end": 18
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 14,
                          "end": 19
                        }
                      }
                    },
                    {
                      "Literal": "y "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "c"
                              },
                              "span": {
                                "start": 22,
                                "end": 24
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 25,
                                "end": 26
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 22,
                          "end": 27
                        }
                      }
                    },
                    {
                      "Literal": " "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "d"
                              },
                              "span": {
                                "start": 28,
                                "end": 30
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "e"
                              },
                              "span": {
                                "start": 32,
                                "end": 33
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 33
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
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
                  "start": 36,
                  "end": 38
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Literal": "ls "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "g"
                        },
                        "span": {
                          "start": 46,
                          "end": 48
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 41,
                  "end": 50
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 50
          }
        }
      },
      "span": {
        "start": 36,
        "end": 51
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "h"
                },
                "span": {
                  "start": 52,
                  "end": 54
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "T",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "i"
                                },
                                "span": {
                                  "start": 65,
                                  "end": 67
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "j"
                                },
                                "span": {
                                  "start": 69,
                                  "end": 70
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 65,
                            "end": 70
                          }
                        }
                      },
                      {
                        "Literal": " "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "k"
                          },
                          "span": {
                            "start": 72,
                            "end": 74
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 57,
                  "end": 78
                }
              }
            }
          },
          "span": {
            "start": 52,
            "end": 78
          }
        }
      },
      "span": {
        "start": 52,
        "end": 79
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79
  }
}

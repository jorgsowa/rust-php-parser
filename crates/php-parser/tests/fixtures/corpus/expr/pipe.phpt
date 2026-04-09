===source===
<?php
$a |> $b |> $c;
$a . $b |> $c . $d;
$a |> $b == $c;
$c == $a |> $b;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
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
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 12,
                        "end": 14,
                        "start_line": 2,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Pipe",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 18,
                  "end": 20,
                  "start_line": 2,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 22,
                        "end": 24,
                        "start_line": 3,
                        "start_col": 0
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 27,
                        "end": 29,
                        "start_line": 3,
                        "start_col": 5
                      }
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 29,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Pipe",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 33,
                        "end": 35,
                        "start_line": 3,
                        "start_col": 11
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 38,
                        "end": 40,
                        "start_line": 3,
                        "start_col": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 33,
                  "end": 40,
                  "start_line": 3,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 40,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 42,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 42,
                        "end": 44,
                        "start_line": 4,
                        "start_col": 0
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 48,
                        "end": 50,
                        "start_line": 4,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 42,
                  "end": 50,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Equal",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 54,
                  "end": 56,
                  "start_line": 4,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 56,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 42,
        "end": 58,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 58,
                  "end": 60,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Equal",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 64,
                        "end": 66,
                        "start_line": 5,
                        "start_col": 6
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 70,
                        "end": 72,
                        "start_line": 5,
                        "start_col": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 64,
                  "end": 72,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 72,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 58,
        "end": 73,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73,
    "start_line": 1,
    "start_col": 0
  }
}

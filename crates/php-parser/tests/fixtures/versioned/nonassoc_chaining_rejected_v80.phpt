===config===
parse_version=8.0
===source===
<?php
$a = 1 < 2 < 3;
$b = 1 == 1 == 1;
$c = $x <=> $y <=> $z;
===errors===
Chaining non-associative operators requires explicit parentheses.
Chaining non-associative operators requires explicit parentheses.
Chaining non-associative operators requires explicit parentheses.
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
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 11,
                              "end": 12
                            }
                          },
                          "op": "Less",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 15,
                              "end": 16
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 16
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Int": 3
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
                  "Variable": "b"
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
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 27,
                              "end": 28
                            }
                          },
                          "op": "Equal",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 32,
                              "end": 33
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 33
                      }
                    },
                    "op": "Equal",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 37,
                        "end": 38
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 38
          }
        }
      },
      "span": {
        "start": 22,
        "end": 39
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
                  "start": 40,
                  "end": 42
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 45,
                              "end": 47
                            }
                          },
                          "op": "Spaceship",
                          "right": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 52,
                              "end": 54
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 45,
                        "end": 54
                      }
                    },
                    "op": "Spaceship",
                    "right": {
                      "kind": {
                        "Variable": "z"
                      },
                      "span": {
                        "start": 59,
                        "end": 61
                      }
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 61
                }
              }
            }
          },
          "span": {
            "start": 40,
            "end": 61
          }
        }
      },
      "span": {
        "start": 40,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}

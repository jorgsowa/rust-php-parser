===source===
<?php
$x = $a |> $b |> $c;
$y = $a + $b |> $c;
$z = $a |> $b + $c;
===errors <=8.4===
'pipe operator (|>)' requires PHP 8.5 or higher
'pipe operator (|>)' requires PHP 8.5 or higher
'pipe operator (|>)' requires PHP 8.5 or higher
'pipe operator (|>)' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '>' in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ">" in Standard input code on line 2
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
                  "Variable": "x"
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
                              "Variable": "a"
                            },
                            "span": {
                              "start": 11,
                              "end": 13
                            }
                          },
                          "op": "Pipe",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 17,
                              "end": 19
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 19
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 23,
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
                  "Variable": "y"
                },
                "span": {
                  "start": 27,
                  "end": 29
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
                              "Variable": "a"
                            },
                            "span": {
                              "start": 32,
                              "end": 34
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 37,
                              "end": 39
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 39
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 43,
                        "end": 45
                      }
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 45
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 45
          }
        }
      },
      "span": {
        "start": 27,
        "end": 46
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 47,
                  "end": 49
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 52,
                        "end": 54
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 58,
                              "end": 60
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 63,
                              "end": 65
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 65
                      }
                    }
                  }
                },
                "span": {
                  "start": 52,
                  "end": 65
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 65
          }
        }
      },
      "span": {
        "start": 47,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}

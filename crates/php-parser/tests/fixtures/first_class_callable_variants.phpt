===source===
<?php
$a = strlen(...);
$b = $obj->method(...);
$d = Foo::bar(...);
$e = $obj->$dynamic(...);
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
                  "CallableCreate": {
                    "kind": {
                      "Function": {
                        "kind": {
                          "Identifier": "strlen"
                        },
                        "span": {
                          "start": 11,
                          "end": 17,
                          "start_line": 2,
                          "start_col": 5
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 22,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
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
                  "start": 24,
                  "end": 26,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Method": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 29,
                            "end": 33,
                            "start_line": 3,
                            "start_col": 5
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "method"
                          },
                          "span": {
                            "start": 35,
                            "end": 41,
                            "start_line": 3,
                            "start_col": 11
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 46,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 46,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 24,
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
                  "Variable": "d"
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
                  "CallableCreate": {
                    "kind": {
                      "StaticMethod": {
                        "class": {
                          "kind": {
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 53,
                            "end": 56,
                            "start_line": 4,
                            "start_col": 5
                          }
                        },
                        "method": "bar"
                      }
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 66,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 66,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 48,
        "end": 68,
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
                  "Variable": "e"
                },
                "span": {
                  "start": 68,
                  "end": 70,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Method": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 73,
                            "end": 77,
                            "start_line": 5,
                            "start_col": 5
                          }
                        },
                        "method": {
                          "kind": {
                            "Variable": "dynamic"
                          },
                          "span": {
                            "start": 79,
                            "end": 87,
                            "start_line": 5,
                            "start_col": 11
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 73,
                  "end": 92,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 92,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 68,
        "end": 93,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php
A::$b;
$A::$b;
'A'::$b;
('A' . '')::$b;
'A'[0]::$b;
A::$$b;
A::$$c[1];
A::$A::$b;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 6,
                  "end": 7,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "member": "b"
            }
          },
          "span": {
            "start": 6,
            "end": 11,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Variable": "A"
                },
                "span": {
                  "start": 13,
                  "end": 15,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "member": "b"
            }
          },
          "span": {
            "start": 13,
            "end": 19,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 13,
        "end": 21,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "String": "A"
                },
                "span": {
                  "start": 21,
                  "end": 24,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "member": "b"
            }
          },
          "span": {
            "start": 21,
            "end": 28,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 21,
        "end": 30,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "A"
                          },
                          "span": {
                            "start": 31,
                            "end": 34,
                            "start_line": 5,
                            "start_col": 1
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "String": ""
                          },
                          "span": {
                            "start": 37,
                            "end": 39,
                            "start_line": 5,
                            "start_col": 7
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 39,
                      "start_line": 5,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 40,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "member": "b"
            }
          },
          "span": {
            "start": 30,
            "end": 44,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 30,
        "end": 46,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "String": "A"
                      },
                      "span": {
                        "start": 46,
                        "end": 49,
                        "start_line": 6,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 50,
                        "end": 51,
                        "start_line": 6,
                        "start_col": 4
                      }
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 52,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "member": "b"
            }
          },
          "span": {
            "start": 46,
            "end": 56,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 46,
        "end": 58,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccessDynamic": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 58,
                  "end": 59,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "member": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 62,
                      "end": 64,
                      "start_line": 7,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 61,
                  "end": 64,
                  "start_line": 7,
                  "start_col": 3
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 64,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 58,
        "end": 66,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "StaticPropertyAccessDynamic": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 66,
                        "end": 67,
                        "start_line": 8,
                        "start_col": 0
                      }
                    },
                    "member": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 70,
                            "end": 72,
                            "start_line": 8,
                            "start_col": 4
                          }
                        }
                      },
                      "span": {
                        "start": 69,
                        "end": 72,
                        "start_line": 8,
                        "start_col": 3
                      }
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 72,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 73,
                  "end": 74,
                  "start_line": 8,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 75,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 66,
        "end": 77,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 77,
                        "end": 78,
                        "start_line": 9,
                        "start_col": 0
                      }
                    },
                    "member": "A"
                  }
                },
                "span": {
                  "start": 77,
                  "end": 82,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "member": "b"
            }
          },
          "span": {
            "start": 77,
            "end": 86,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 77,
        "end": 87,
        "start_line": 9,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87,
    "start_line": 1,
    "start_col": 0
  }
}

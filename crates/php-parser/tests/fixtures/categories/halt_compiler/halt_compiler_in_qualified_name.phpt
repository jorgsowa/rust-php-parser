===source===
<?php
\__halt_compiler();
Foo\__halt_compiler();
namespace\__halt_compiler();
__halt_compiler\foo();
$a = new \__halt_compiler;
$b = \__halt_compiler\X::y;
$c = $a instanceof Foo\__halt_compiler;
echo 1;
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "__halt_compiler"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 6,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "args": []
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
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo",
                      "__halt_compiler"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 26,
                      "end": 45
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 45
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 26,
            "end": 47
          }
        }
      },
      "span": {
        "start": 26,
        "end": 48
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "__halt_compiler"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 49,
                      "end": 74
                    }
                  }
                },
                "span": {
                  "start": 49,
                  "end": 74
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 49,
            "end": 76
          }
        }
      },
      "span": {
        "start": 49,
        "end": 77
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "__halt_compiler",
                      "foo"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 78,
                      "end": 97
                    }
                  }
                },
                "span": {
                  "start": 78,
                  "end": 97
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 78,
            "end": 99
          }
        }
      },
      "span": {
        "start": 78,
        "end": 100
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
                  "start": 101,
                  "end": 103
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "__halt_compiler"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 110,
                            "end": 126
                          }
                        }
                      },
                      "span": {
                        "start": 110,
                        "end": 126
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 106,
                  "end": 126
                }
              }
            }
          },
          "span": {
            "start": 101,
            "end": 126
          }
        }
      },
      "span": {
        "start": 101,
        "end": 127
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
                  "start": 128,
                  "end": 130
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "__halt_compiler",
                            "X"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 133,
                            "end": 151
                          }
                        }
                      },
                      "span": {
                        "start": 133,
                        "end": 151
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "y"
                      },
                      "span": {
                        "start": 153,
                        "end": 154
                      }
                    }
                  }
                },
                "span": {
                  "start": 133,
                  "end": 154
                }
              }
            }
          },
          "span": {
            "start": 128,
            "end": 154
          }
        }
      },
      "span": {
        "start": 128,
        "end": 155
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
                  "start": 156,
                  "end": 158
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
                        "start": 161,
                        "end": 163
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo",
                            "__halt_compiler"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 175,
                            "end": 194
                          }
                        }
                      },
                      "span": {
                        "start": 175,
                        "end": 194
                      }
                    }
                  }
                },
                "span": {
                  "start": 161,
                  "end": 194
                }
              }
            }
          },
          "span": {
            "start": 156,
            "end": 194
          }
        }
      },
      "span": {
        "start": 156,
        "end": 195
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 201,
              "end": 202
            }
          }
        ]
      },
      "span": {
        "start": 196,
        "end": 203
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 203
  }
}

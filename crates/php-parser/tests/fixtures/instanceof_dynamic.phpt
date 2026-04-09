===source===
<?php
$a = $obj instanceof $className;
$b = $obj instanceof self;
$c = $obj instanceof parent;
$d = $obj instanceof static;
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 11,
                        "end": 15,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Variable": "className"
                      },
                      "span": {
                        "start": 27,
                        "end": 37,
                        "start_line": 2,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 37,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 37,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 39,
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
                  "start": 39,
                  "end": 41,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 44,
                        "end": 48,
                        "start_line": 3,
                        "start_col": 5
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "self"
                      },
                      "span": {
                        "start": 60,
                        "end": 64,
                        "start_line": 3,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 44,
                  "end": 64,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 64,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 39,
        "end": 66,
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
                  "Variable": "c"
                },
                "span": {
                  "start": 66,
                  "end": 68,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 71,
                        "end": 75,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "parent"
                      },
                      "span": {
                        "start": 87,
                        "end": 93,
                        "start_line": 4,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 71,
                  "end": 93,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 93,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 66,
        "end": 95,
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
                  "Variable": "d"
                },
                "span": {
                  "start": 95,
                  "end": 97,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 100,
                        "end": 104,
                        "start_line": 5,
                        "start_col": 5
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "static"
                      },
                      "span": {
                        "start": 116,
                        "end": 122,
                        "start_line": 5,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 100,
                  "end": 122,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 95,
            "end": 122,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 95,
        "end": 123,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 123,
    "start_line": 1,
    "start_col": 0
  }
}

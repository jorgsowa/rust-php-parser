===source===
<?php
new int\X; $a instanceof string\Y; int\f(); float\C::D; $v = bool\E;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "int",
                      "X"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 10,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 15
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Name": {
                    "parts": [
                      "string",
                      "Y"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 31,
                      "end": 39
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 39
          }
        }
      },
      "span": {
        "start": 17,
        "end": 40
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
                      "int",
                      "f"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 41,
                      "end": 46
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 46
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 41,
            "end": 48
          }
        }
      },
      "span": {
        "start": 41,
        "end": 49
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "float",
                      "C"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 50,
                      "end": 57
                    }
                  }
                },
                "span": {
                  "start": 50,
                  "end": 57
                }
              },
              "member": {
                "kind": {
                  "Identifier": "D"
                },
                "span": {
                  "start": 59,
                  "end": 60
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 60
          }
        }
      },
      "span": {
        "start": 50,
        "end": 61
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "v"
                },
                "span": {
                  "start": 62,
                  "end": 64
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Name": {
                    "parts": [
                      "bool",
                      "E"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 67,
                      "end": 73
                    }
                  }
                },
                "span": {
                  "start": 67,
                  "end": 73
                }
              }
            }
          },
          "span": {
            "start": 62,
            "end": 73
          }
        }
      },
      "span": {
        "start": 62,
        "end": 74
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74
  }
}

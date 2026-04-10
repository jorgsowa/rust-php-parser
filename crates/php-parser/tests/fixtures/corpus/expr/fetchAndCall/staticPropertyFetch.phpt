===source===
<?php

// property name variations
A::$b;
A::$$b;
A::${'b'};

// array access
A::$b['c'];

// class name variations can be found in staticCall.test
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
                  "start": 35,
                  "end": 36
                }
              },
              "member": "b"
            }
          },
          "span": {
            "start": 35,
            "end": 40
          }
        }
      },
      "span": {
        "start": 35,
        "end": 41
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
                  "start": 42,
                  "end": 43
                }
              },
              "member": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 46,
                      "end": 48
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 48
          }
        }
      },
      "span": {
        "start": 42,
        "end": 49
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
                  "start": 50,
                  "end": 51
                }
              },
              "member": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 55,
                      "end": 58
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 58
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 58
          }
        }
      },
      "span": {
        "start": 50,
        "end": 60
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 78,
                        "end": 79
                      }
                    },
                    "member": "b"
                  }
                },
                "span": {
                  "start": 78,
                  "end": 83
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 84,
                  "end": 87
                }
              }
            }
          },
          "span": {
            "start": 78,
            "end": 88
          }
        }
      },
      "span": {
        "start": 78,
        "end": 89
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 89
  }
}

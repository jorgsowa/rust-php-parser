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
                  "end": 36,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "member": "b"
            }
          },
          "span": {
            "start": 35,
            "end": 40,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 35,
        "end": 42,
        "start_line": 4,
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
                  "start": 42,
                  "end": 43,
                  "start_line": 5,
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
                      "start": 46,
                      "end": 48,
                      "start_line": 5,
                      "start_col": 4
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 48,
                  "start_line": 5,
                  "start_col": 3
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 48,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 42,
        "end": 50,
        "start_line": 5,
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
                  "start": 50,
                  "end": 51,
                  "start_line": 6,
                  "start_col": 0
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
                      "end": 58,
                      "start_line": 6,
                      "start_col": 5
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 58,
                  "start_line": 6,
                  "start_col": 3
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 58,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 50,
        "end": 78,
        "start_line": 6,
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
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 78,
                        "end": 79,
                        "start_line": 9,
                        "start_col": 0
                      }
                    },
                    "member": "b"
                  }
                },
                "span": {
                  "start": 78,
                  "end": 83,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 84,
                  "end": 87,
                  "start_line": 9,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 78,
            "end": 88,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 78,
        "end": 147,
        "start_line": 9,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 147,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php

$a;
${'a'};
${foo()};
$$a;
$$$a;
$$a['b'];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "a"
          },
          "span": {
            "start": 7,
            "end": 9,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 11,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "VariableVariable": {
              "kind": {
                "String": "a"
              },
              "span": {
                "start": 13,
                "end": 16,
                "start_line": 4,
                "start_col": 2
              }
            }
          },
          "span": {
            "start": 11,
            "end": 16,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 11,
        "end": 19,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "VariableVariable": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Identifier": "foo"
                    },
                    "span": {
                      "start": 21,
                      "end": 24,
                      "start_line": 5,
                      "start_col": 2
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 21,
                "end": 26,
                "start_line": 5,
                "start_col": 2
              }
            }
          },
          "span": {
            "start": 19,
            "end": 26,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 19,
        "end": 29,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "VariableVariable": {
              "kind": {
                "Variable": "a"
              },
              "span": {
                "start": 30,
                "end": 32,
                "start_line": 6,
                "start_col": 1
              }
            }
          },
          "span": {
            "start": 29,
            "end": 32,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 29,
        "end": 34,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "VariableVariable": {
              "kind": {
                "VariableVariable": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 36,
                    "end": 38,
                    "start_line": 7,
                    "start_col": 2
                  }
                }
              },
              "span": {
                "start": 35,
                "end": 38,
                "start_line": 7,
                "start_col": 1
              }
            }
          },
          "span": {
            "start": 34,
            "end": 38,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 34,
        "end": 40,
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
                  "VariableVariable": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 41,
                      "end": 43,
                      "start_line": 8,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 40,
                  "end": 43,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 44,
                  "end": 47,
                  "start_line": 8,
                  "start_col": 4
                }
              }
            }
          },
          "span": {
            "start": 40,
            "end": 48,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 40,
        "end": 49,
        "start_line": 8,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49,
    "start_line": 1,
    "start_col": 0
  }
}

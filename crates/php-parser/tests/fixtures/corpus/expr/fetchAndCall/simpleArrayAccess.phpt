===source===
<?php

$a['b'];
$a['b']['c'];
$a[] = $b;
${$a}['b'];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 7,
                  "end": 9,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 10,
                  "end": 13,
                  "start_line": 3,
                  "start_col": 3
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 14,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 16,
        "start_line": 3,
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 16,
                        "end": 18,
                        "start_line": 4,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 19,
                        "end": 22,
                        "start_line": 4,
                        "start_col": 3
                      }
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 23,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 24,
                  "end": 27,
                  "start_line": 4,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 28,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 16,
        "end": 30,
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 30,
                        "end": 32,
                        "start_line": 5,
                        "start_col": 0
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 30,
                  "end": 35,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
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
            "start": 30,
            "end": 39,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 30,
        "end": 41,
        "start_line": 5,
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
                      "start": 43,
                      "end": 45,
                      "start_line": 6,
                      "start_col": 2
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 45,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 47,
                  "end": 50,
                  "start_line": 6,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 51,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 41,
        "end": 52,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52,
    "start_line": 1,
    "start_col": 0
  }
}

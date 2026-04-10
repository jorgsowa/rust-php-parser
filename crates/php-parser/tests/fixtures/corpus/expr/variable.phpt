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
            "end": 9
          }
        }
      },
      "span": {
        "start": 7,
        "end": 10
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
                "end": 16
              }
            }
          },
          "span": {
            "start": 11,
            "end": 16
          }
        }
      },
      "span": {
        "start": 11,
        "end": 18
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
                      "end": 24
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 21,
                "end": 26
              }
            }
          },
          "span": {
            "start": 19,
            "end": 26
          }
        }
      },
      "span": {
        "start": 19,
        "end": 28
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
                "end": 32
              }
            }
          },
          "span": {
            "start": 29,
            "end": 32
          }
        }
      },
      "span": {
        "start": 29,
        "end": 33
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
                    "end": 38
                  }
                }
              },
              "span": {
                "start": 35,
                "end": 38
              }
            }
          },
          "span": {
            "start": 34,
            "end": 38
          }
        }
      },
      "span": {
        "start": 34,
        "end": 39
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
                      "end": 43
                    }
                  }
                },
                "span": {
                  "start": 40,
                  "end": 43
                }
              },
              "index": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 44,
                  "end": 47
                }
              }
            }
          },
          "span": {
            "start": 40,
            "end": 48
          }
        }
      },
      "span": {
        "start": 40,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}

===config===
min_php=8.1
===source===
<?php
$a > $b == $c;
$a >= $b == $c;
$a instanceof Foo == $c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "op": "Greater",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Equal",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 17,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 21,
                        "end": 23
                      }
                    },
                    "op": "GreaterOrEqual",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 27,
                        "end": 29
                      }
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 29
                }
              },
              "op": "Equal",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 33,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 35
          }
        }
      },
      "span": {
        "start": 21,
        "end": 36
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 51,
                        "end": 54
                      }
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 54
                }
              },
              "op": "Equal",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 58,
                  "end": 60
                }
              }
            }
          },
          "span": {
            "start": 37,
            "end": 60
          }
        }
      },
      "span": {
        "start": 37,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}

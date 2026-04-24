===source===
<?php
$a = clone (object) $b;
$c = clone (int) $x;
$d = clone (array) $y;
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
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "Cast": [
                        "Object",
                        {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 26,
                            "end": 28
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 17,
                      "end": 28
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
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
                  "start": 30,
                  "end": 32
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "Cast": [
                        "Int",
                        {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 47,
                            "end": 49
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 41,
                      "end": 49
                    }
                  }
                },
                "span": {
                  "start": 35,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 49
          }
        }
      },
      "span": {
        "start": 30,
        "end": 50
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
                  "start": 51,
                  "end": 53
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "Cast": [
                        "Array",
                        {
                          "kind": {
                            "Variable": "y"
                          },
                          "span": {
                            "start": 70,
                            "end": 72
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 62,
                      "end": 72
                    }
                  }
                },
                "span": {
                  "start": 56,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 72
          }
        }
      },
      "span": {
        "start": 51,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}

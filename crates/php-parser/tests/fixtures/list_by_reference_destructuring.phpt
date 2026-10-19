===source===
<?php
[&$a, &$b] = $arr;
list(&$x, &$y) = $pair;
[&$first, $second] = $mixed;
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 8,
                            "end": 10
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 10
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 19,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 31,
                            "end": 33
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 33
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "y"
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
                  ]
                },
                "span": {
                  "start": 25,
                  "end": 39
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "pair"
                },
                "span": {
                  "start": 42,
                  "end": 47
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 47
          }
        }
      },
      "span": {
        "start": 25,
        "end": 48
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "first"
                          },
                          "span": {
                            "start": 51,
                            "end": 57
                          }
                        }
                      },
                      "span": {
                        "start": 50,
                        "end": 57
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "second"
                          },
                          "span": {
                            "start": 59,
                            "end": 66
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 66
                      }
                    }
                  ]
                },
                "span": {
                  "start": 49,
                  "end": 67
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "mixed"
                },
                "span": {
                  "start": 70,
                  "end": 76
                }
              }
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
    }
  ],
  "span": {
    "start": 0,
    "end": 77
  }
}

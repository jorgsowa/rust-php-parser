===source===
<?php
$a = clone $b ** 2;
$c = clone $d->e ** 2;
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Clone": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 17,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 19
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
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
                  "start": 26,
                  "end": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Clone": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "d"
                                },
                                "span": {
                                  "start": 37,
                                  "end": 39
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "e"
                                },
                                "span": {
                                  "start": 41,
                                  "end": 42
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 37,
                            "end": 42
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 42
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 46,
                        "end": 47
                      }
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 47
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 47
          }
        }
      },
      "span": {
        "start": 26,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}

===description===
`"a" . 1 << 3 . "b"` parses as `"a" . (1 << 3) . "b"`: `<<` binds tighter than `.`.
===source===
<?php
"a" . 1 << 3 . "b";
===ast <=7.4===
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
                        "String": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 9
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 12,
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
              "op": "ShiftLeft",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 21,
                        "end": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 17,
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
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
===ast >=8.0===
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
                        "String": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 9
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 12,
                              "end": 13
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 21,
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
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}

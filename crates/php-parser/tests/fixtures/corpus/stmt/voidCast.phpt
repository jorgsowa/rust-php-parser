===source===
<?php
(void)foo();
( VOID ) foo();
(void)$a or $b;

// This is explicitly allowed.
for ((void)a(); $b; (void)$c) {
}

// PHP does not allow this, but the parser accepts it.
$x = (void) $y;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "foo"
                      },
                      "span": {
                        "start": 12,
                        "end": 15,
                        "start_line": 2,
                        "start_col": 6
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 17,
                  "start_line": 2,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 17,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "foo"
                      },
                      "span": {
                        "start": 28,
                        "end": 31,
                        "start_line": 3,
                        "start_col": 9
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 28,
                  "end": 33,
                  "start_line": 3,
                  "start_col": 9
                }
              }
            ]
          },
          "span": {
            "start": 19,
            "end": 33,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 19,
        "end": 35,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Cast": [
                    "Void",
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 41,
                        "end": 43,
                        "start_line": 4,
                        "start_col": 6
                      }
                    }
                  ]
                },
                "span": {
                  "start": 35,
                  "end": 43,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 47,
                  "end": 49,
                  "start_line": 4,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 35,
            "end": 49,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 35,
        "end": 83,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Cast": [
                  "Void",
                  {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Identifier": "a"
                          },
                          "span": {
                            "start": 94,
                            "end": 95,
                            "start_line": 7,
                            "start_col": 11
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 94,
                      "end": 97,
                      "start_line": 7,
                      "start_col": 11
                    }
                  }
                ]
              },
              "span": {
                "start": 88,
                "end": 97,
                "start_line": 7,
                "start_col": 5
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Variable": "b"
              },
              "span": {
                "start": 99,
                "end": 101,
                "start_line": 7,
                "start_col": 16
              }
            }
          ],
          "update": [
            {
              "kind": {
                "Cast": [
                  "Void",
                  {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 109,
                      "end": 111,
                      "start_line": 7,
                      "start_col": 26
                    }
                  }
                ]
              },
              "span": {
                "start": 103,
                "end": 111,
                "start_line": 7,
                "start_col": 20
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 113,
              "end": 116,
              "start_line": 7,
              "start_col": 30
            }
          }
        }
      },
      "span": {
        "start": 83,
        "end": 116,
        "start_line": 7,
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
                  "Variable": "x"
                },
                "span": {
                  "start": 173,
                  "end": 175,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Cast": [
                    "Void",
                    {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 185,
                        "end": 187,
                        "start_line": 11,
                        "start_col": 12
                      }
                    }
                  ]
                },
                "span": {
                  "start": 178,
                  "end": 187,
                  "start_line": 11,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 173,
            "end": 187,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 173,
        "end": 188,
        "start_line": 11,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 188,
    "start_line": 1,
    "start_col": 0
  }
}

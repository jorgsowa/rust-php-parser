===source===
<?php

// "classical" loop
for ($i = 0; $i < $c; ++$i) {}

// multiple expressions
for ($a, $b; $c, $d; $e, $f) {}

// infinite loop
for (;;) {}

// alternative syntax
for (;;):
endfor;
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 32,
                      "end": 34,
                      "start_line": 4,
                      "start_col": 5
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 37,
                      "end": 38,
                      "start_line": 4,
                      "start_col": 10
                    }
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 38,
                "start_line": 4,
                "start_col": 5
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 40,
                      "end": 42,
                      "start_line": 4,
                      "start_col": 13
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 45,
                      "end": 47,
                      "start_line": 4,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 40,
                "end": 47,
                "start_line": 4,
                "start_col": 13
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPrefix": {
                  "op": "PreIncrement",
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 51,
                      "end": 53,
                      "start_line": 4,
                      "start_col": 24
                    }
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 53,
                "start_line": 4,
                "start_col": 22
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 55,
              "end": 57,
              "start_line": 4,
              "start_col": 28
            }
          }
        }
      },
      "span": {
        "start": 27,
        "end": 57,
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
                "Variable": "a"
              },
              "span": {
                "start": 88,
                "end": 90,
                "start_line": 7,
                "start_col": 5
              }
            },
            {
              "kind": {
                "Variable": "b"
              },
              "span": {
                "start": 92,
                "end": 94,
                "start_line": 7,
                "start_col": 9
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Variable": "c"
              },
              "span": {
                "start": 96,
                "end": 98,
                "start_line": 7,
                "start_col": 13
              }
            },
            {
              "kind": {
                "Variable": "d"
              },
              "span": {
                "start": 100,
                "end": 102,
                "start_line": 7,
                "start_col": 17
              }
            }
          ],
          "update": [
            {
              "kind": {
                "Variable": "e"
              },
              "span": {
                "start": 104,
                "end": 106,
                "start_line": 7,
                "start_col": 21
              }
            },
            {
              "kind": {
                "Variable": "f"
              },
              "span": {
                "start": 108,
                "end": 110,
                "start_line": 7,
                "start_col": 25
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 112,
              "end": 114,
              "start_line": 7,
              "start_col": 29
            }
          }
        }
      },
      "span": {
        "start": 83,
        "end": 114,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [],
          "update": [],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 142,
              "end": 144,
              "start_line": 10,
              "start_col": 9
            }
          }
        }
      },
      "span": {
        "start": 133,
        "end": 144,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [],
          "update": [],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 168,
              "end": 185,
              "start_line": 13,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 168,
        "end": 185,
        "start_line": 13,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 185,
    "start_line": 1,
    "start_col": 0
  }
}

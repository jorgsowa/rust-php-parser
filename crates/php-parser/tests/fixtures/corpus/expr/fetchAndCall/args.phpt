===source===
<?php

f();
f($a);
f($a, $b);
f(&$a);
f($a, ...$b);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 7,
                  "end": 8,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 10,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 12,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 12,
                  "end": 13,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 14,
                      "end": 16,
                      "start_line": 4,
                      "start_col": 2
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 16,
                    "start_line": 4,
                    "start_col": 2
                  }
                }
              ]
            }
          },
          "span": {
            "start": 12,
            "end": 17,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 12,
        "end": 19,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 19,
                  "end": 20,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 21,
                      "end": 23,
                      "start_line": 5,
                      "start_col": 2
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 23,
                    "start_line": 5,
                    "start_col": 2
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 25,
                      "end": 27,
                      "start_line": 5,
                      "start_col": 6
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 25,
                    "end": 27,
                    "start_line": 5,
                    "start_col": 6
                  }
                }
              ]
            }
          },
          "span": {
            "start": 19,
            "end": 28,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 19,
        "end": 30,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 30,
                  "end": 31,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 33,
                      "end": 35,
                      "start_line": 6,
                      "start_col": 3
                    }
                  },
                  "unpack": false,
                  "by_ref": true,
                  "span": {
                    "start": 32,
                    "end": 35,
                    "start_line": 6,
                    "start_col": 2
                  }
                }
              ]
            }
          },
          "span": {
            "start": 30,
            "end": 36,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 30,
        "end": 38,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 38,
                  "end": 39,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 40,
                      "end": 42,
                      "start_line": 7,
                      "start_col": 2
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 40,
                    "end": 42,
                    "start_line": 7,
                    "start_col": 2
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 47,
                      "end": 49,
                      "start_line": 7,
                      "start_col": 9
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 44,
                    "end": 49,
                    "start_line": 7,
                    "start_col": 6
                  }
                }
              ]
            }
          },
          "span": {
            "start": 38,
            "end": 50,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 38,
        "end": 51,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51,
    "start_line": 1,
    "start_col": 0
  }
}

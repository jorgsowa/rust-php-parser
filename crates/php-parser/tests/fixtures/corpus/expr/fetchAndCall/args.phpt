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
                  "end": 8
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 10
          }
        }
      },
      "span": {
        "start": 7,
        "end": 12
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
                  "end": 13
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
                      "end": 16
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 16
                  }
                }
              ]
            }
          },
          "span": {
            "start": 12,
            "end": 17
          }
        }
      },
      "span": {
        "start": 12,
        "end": 19
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
                  "end": 20
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
                      "end": 23
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 23
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
                      "end": 27
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 25,
                    "end": 27
                  }
                }
              ]
            }
          },
          "span": {
            "start": 19,
            "end": 28
          }
        }
      },
      "span": {
        "start": 19,
        "end": 30
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
                  "end": 31
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
                      "end": 35
                    }
                  },
                  "unpack": false,
                  "by_ref": true,
                  "span": {
                    "start": 32,
                    "end": 35
                  }
                }
              ]
            }
          },
          "span": {
            "start": 30,
            "end": 36
          }
        }
      },
      "span": {
        "start": 30,
        "end": 38
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
                  "end": 39
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
                      "end": 42
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 40,
                    "end": 42
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
                      "end": 49
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 44,
                    "end": 49
                  }
                }
              ]
            }
          },
          "span": {
            "start": 38,
            "end": 50
          }
        }
      },
      "span": {
        "start": 38,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}

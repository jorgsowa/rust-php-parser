===source===
<?php

f();
f($a);
f($a, $b);
f(&$a);
f($a, ...$b);
===errors===
call-time pass-by-reference is not allowed
===php_error===
PHP Parse error:  syntax error, unexpected token "&" in Standard input code on line 6
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
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 7,
                      "end": 8
                    }
                  }
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
        "end": 11
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 12,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 14,
                        "end": 16
                      }
                    }
                  },
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
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 20
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 20
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 21,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 23
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 25,
                        "end": 27
                      }
                    }
                  },
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
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 31
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "ByRef": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 33,
                        "end": 35
                      }
                    }
                  },
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
        "end": 37
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 38,
                      "end": 39
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 39
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 40,
                        "end": 42
                      }
                    }
                  },
                  "span": {
                    "start": 40,
                    "end": 42
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 47,
                        "end": 49
                      }
                    }
                  },
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

===source===
<?php
$a = strlen(...);
$b = $obj->method(...);
$d = Foo::bar(...);
$e = $obj->$dynamic(...);
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
                  "CallableCreate": {
                    "kind": {
                      "Function": {
                        "kind": {
                          "Identifier": "strlen"
                        },
                        "span": {
                          "start": 11,
                          "end": 17
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 24,
                  "end": 26
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Method": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 29,
                            "end": 33
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "method"
                          },
                          "span": {
                            "start": 35,
                            "end": 41
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 46
          }
        }
      },
      "span": {
        "start": 24,
        "end": 47
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
                  "start": 48,
                  "end": 50
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "StaticMethod": {
                        "class": {
                          "kind": {
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 53,
                            "end": 56
                          }
                        },
                        "method": {
                          "name": "bar",
                          "span": {
                            "start": 58,
                            "end": 61
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 66
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 66
          }
        }
      },
      "span": {
        "start": 48,
        "end": 67
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 68,
                  "end": 70
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Method": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 73,
                            "end": 77
                          }
                        },
                        "method": {
                          "kind": {
                            "Variable": "dynamic"
                          },
                          "span": {
                            "start": 79,
                            "end": 87
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 73,
                  "end": 92
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 92
          }
        }
      },
      "span": {
        "start": 68,
        "end": 93
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93
  }
}

===source===
<?php
$a = Foo::bar(...);
$b = Foo::$prop;
$c = Foo::CONST;
$d = static::method();
$e = parent::method();
$f = self::$prop;
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
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
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
                            "start": 11,
                            "end": 14,
                            "start_line": 2,
                            "start_col": 5
                          }
                        },
                        "method": "bar"
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 24,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26,
        "start_line": 2,
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
                  "Variable": "b"
                },
                "span": {
                  "start": 26,
                  "end": 28,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 31,
                        "end": 34,
                        "start_line": 3,
                        "start_col": 5
                      }
                    },
                    "member": "prop"
                  }
                },
                "span": {
                  "start": 31,
                  "end": 41,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 41,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 26,
        "end": 43,
        "start_line": 3,
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
                  "Variable": "c"
                },
                "span": {
                  "start": 43,
                  "end": 45,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 48,
                        "end": 51,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    "member": "CONST"
                  }
                },
                "span": {
                  "start": 48,
                  "end": 58,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 58,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 43,
        "end": 60,
        "start_line": 4,
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
                  "Variable": "d"
                },
                "span": {
                  "start": 60,
                  "end": 62,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Identifier": "static"
                      },
                      "span": {
                        "start": 65,
                        "end": 71,
                        "start_line": 5,
                        "start_col": 5
                      }
                    },
                    "method": "method",
                    "args": []
                  }
                },
                "span": {
                  "start": 65,
                  "end": 81,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 60,
            "end": 81,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 60,
        "end": 83,
        "start_line": 5,
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
                  "Variable": "e"
                },
                "span": {
                  "start": 83,
                  "end": 85,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Identifier": "parent"
                      },
                      "span": {
                        "start": 88,
                        "end": 94,
                        "start_line": 6,
                        "start_col": 5
                      }
                    },
                    "method": "method",
                    "args": []
                  }
                },
                "span": {
                  "start": 88,
                  "end": 104,
                  "start_line": 6,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 104,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 83,
        "end": 106,
        "start_line": 6,
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
                  "Variable": "f"
                },
                "span": {
                  "start": 106,
                  "end": 108,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "self"
                      },
                      "span": {
                        "start": 111,
                        "end": 115,
                        "start_line": 7,
                        "start_col": 5
                      }
                    },
                    "member": "prop"
                  }
                },
                "span": {
                  "start": 111,
                  "end": 122,
                  "start_line": 7,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 106,
            "end": 122,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 106,
        "end": 123,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 123,
    "start_line": 1,
    "start_col": 0
  }
}

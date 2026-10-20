===source===
<?php
$a = Foo::bar(...);
$b = Foo::$prop;
$c = Foo::CONST;
$d = static::method();
$e = parent::method();
$f = self::$prop;
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
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
                      "StaticMethod": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 11,
                                "end": 14
                              }
                            }
                          },
                          "span": {
                            "start": 11,
                            "end": 14
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "bar"
                          },
                          "span": {
                            "start": 16,
                            "end": 19
                          }
                        }
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
                  "Variable": "b"
                },
                "span": {
                  "start": 26,
                  "end": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 31,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 34
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "prop"
                      },
                      "span": {
                        "start": 36,
                        "end": 41
                      }
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 41
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 41
          }
        }
      },
      "span": {
        "start": 26,
        "end": 42
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
                  "end": 45
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 48,
                            "end": 51
                          }
                        }
                      },
                      "span": {
                        "start": 48,
                        "end": 51
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "CONST"
                      },
                      "span": {
                        "start": 53,
                        "end": 58
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 58
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 58
          }
        }
      },
      "span": {
        "start": 43,
        "end": 59
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
                  "end": 62
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "static"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 65,
                            "end": 71
                          }
                        }
                      },
                      "span": {
                        "start": 65,
                        "end": 71
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method"
                      },
                      "span": {
                        "start": 73,
                        "end": 79
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 65,
                  "end": 81
                }
              }
            }
          },
          "span": {
            "start": 60,
            "end": 81
          }
        }
      },
      "span": {
        "start": 60,
        "end": 82
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
                  "end": 85
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "parent"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 88,
                            "end": 94
                          }
                        }
                      },
                      "span": {
                        "start": 88,
                        "end": 94
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method"
                      },
                      "span": {
                        "start": 96,
                        "end": 102
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 88,
                  "end": 104
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 104
          }
        }
      },
      "span": {
        "start": 83,
        "end": 105
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
                  "end": 108
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "self"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 111,
                            "end": 115
                          }
                        }
                      },
                      "span": {
                        "start": 111,
                        "end": 115
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "prop"
                      },
                      "span": {
                        "start": 117,
                        "end": 122
                      }
                    }
                  }
                },
                "span": {
                  "start": 111,
                  "end": 122
                }
              }
            }
          },
          "span": {
            "start": 106,
            "end": 122
          }
        }
      },
      "span": {
        "start": 106,
        "end": 123
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 123
  }
}

===source===
<?php

Foo::$method();
Foo::$method(1, 2);
static::$fn();
$obj::$fn();
self::$method();
parent::$method();

// first-class callable — produces CallableCreate, not StaticDynMethodCall
Foo::$method(...);

// chained array access before call — produces FunctionCall(ArrayAccess(StaticPropertyAccess))
Foo::$method['key']();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 7,
                  "end": 10
                }
              },
              "method": {
                "kind": {
                  "Variable": "method"
                },
                "span": {
                  "start": 12,
                  "end": 19
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 21
          }
        }
      },
      "span": {
        "start": 7,
        "end": 22
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 23,
                  "end": 26
                }
              },
              "method": {
                "kind": {
                  "Variable": "method"
                },
                "span": {
                  "start": 28,
                  "end": 35
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 36,
                    "end": 37
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 39,
                    "end": 40
                  }
                }
              ]
            }
          },
          "span": {
            "start": 23,
            "end": 41
          }
        }
      },
      "span": {
        "start": 23,
        "end": 42
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 43,
                  "end": 49
                }
              },
              "method": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 51,
                  "end": 54
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 43,
            "end": 56
          }
        }
      },
      "span": {
        "start": 43,
        "end": 57
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 58,
                  "end": 62
                }
              },
              "method": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 64,
                  "end": 67
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 58,
            "end": 69
          }
        }
      },
      "span": {
        "start": 58,
        "end": 70
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "self"
                },
                "span": {
                  "start": 71,
                  "end": 75
                }
              },
              "method": {
                "kind": {
                  "Variable": "method"
                },
                "span": {
                  "start": 77,
                  "end": 84
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 71,
            "end": 86
          }
        }
      },
      "span": {
        "start": 71,
        "end": 87
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticDynMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "parent"
                },
                "span": {
                  "start": 88,
                  "end": 94
                }
              },
              "method": {
                "kind": {
                  "Variable": "method"
                },
                "span": {
                  "start": 96,
                  "end": 103
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 88,
            "end": 105
          }
        }
      },
      "span": {
        "start": 88,
        "end": 106
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "StaticMethod": {
                  "class": {
                    "kind": {
                      "Identifier": "Foo"
                    },
                    "span": {
                      "start": 185,
                      "end": 188
                    }
                  },
                  "method": {
                    "kind": {
                      "Variable": "method"
                    },
                    "span": {
                      "start": 190,
                      "end": 197
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 185,
            "end": 202
          }
        }
      },
      "span": {
        "start": 185,
        "end": 203
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "StaticPropertyAccess": {
                          "class": {
                            "kind": {
                              "Identifier": "Foo"
                            },
                            "span": {
                              "start": 302,
                              "end": 305
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "method"
                            },
                            "span": {
                              "start": 307,
                              "end": 314
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 302,
                        "end": 314
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "key"
                      },
                      "span": {
                        "start": 315,
                        "end": 320
                      }
                    }
                  }
                },
                "span": {
                  "start": 302,
                  "end": 321
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 302,
            "end": 323
          }
        }
      },
      "span": {
        "start": 302,
        "end": 324
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 324
  }
}

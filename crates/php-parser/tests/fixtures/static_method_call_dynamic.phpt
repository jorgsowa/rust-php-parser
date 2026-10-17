===source===
<?php

Foo::$method();
Foo::$method(1, 2);
static::$fn();
$obj::$fn();
self::$method();
parent::$method();

// first-class callable — produces CallableCreate, not StaticMethodCallDynamic
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
            "StaticMethodCallDynamic": {
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
            "StaticMethodCallDynamic": {
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
            "StaticMethodCallDynamic": {
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
            "StaticMethodCallDynamic": {
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
            "StaticMethodCallDynamic": {
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
            "StaticMethodCallDynamic": {
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
                      "start": 189,
                      "end": 192
                    }
                  },
                  "method": {
                    "kind": {
                      "Variable": "method"
                    },
                    "span": {
                      "start": 194,
                      "end": 201
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 189,
            "end": 206
          }
        }
      },
      "span": {
        "start": 189,
        "end": 207
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
                              "start": 306,
                              "end": 309
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "method"
                            },
                            "span": {
                              "start": 311,
                              "end": 318
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 306,
                        "end": 318
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "key"
                      },
                      "span": {
                        "start": 319,
                        "end": 324
                      }
                    }
                  }
                },
                "span": {
                  "start": 306,
                  "end": 325
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 306,
            "end": 327
          }
        }
      },
      "span": {
        "start": 306,
        "end": 328
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 328
  }
}

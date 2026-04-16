===source===
<?php
foo(a: 1, b: 2, c: 3);
bar(...$args, extra: true);
baz(1, 2, name: 'test');
array_map(callback: fn($x) => $x * 2, array: $arr);
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
                  "Identifier": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 10,
                      "end": 11
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 13,
                      "end": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 14
                  }
                },
                {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 19,
                      "end": 20
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 20
                  }
                },
                {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 22,
                      "end": 23
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 25,
                      "end": 26
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 22,
                    "end": 26
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 29,
                  "end": 32
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "args"
                    },
                    "span": {
                      "start": 36,
                      "end": 41
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 33,
                    "end": 41
                  }
                },
                {
                  "name": {
                    "name": "extra",
                    "span": {
                      "start": 43,
                      "end": 48
                    }
                  },
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 50,
                      "end": 54
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 43,
                    "end": 54
                  }
                }
              ]
            }
          },
          "span": {
            "start": 29,
            "end": 55
          }
        }
      },
      "span": {
        "start": 29,
        "end": 56
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "baz"
                },
                "span": {
                  "start": 57,
                  "end": 60
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
                      "start": 61,
                      "end": 62
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 61,
                    "end": 62
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 64,
                    "end": 65
                  }
                },
                {
                  "name": {
                    "name": "name",
                    "span": {
                      "start": 67,
                      "end": 71
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "test"
                    },
                    "span": {
                      "start": 73,
                      "end": 79
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 67,
                    "end": 79
                  }
                }
              ]
            }
          },
          "span": {
            "start": 57,
            "end": 80
          }
        }
      },
      "span": {
        "start": 57,
        "end": 81
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "array_map"
                },
                "span": {
                  "start": 82,
                  "end": 91
                }
              },
              "args": [
                {
                  "name": {
                    "name": "callback",
                    "span": {
                      "start": 92,
                      "end": 100
                    }
                  },
                  "value": {
                    "kind": {
                      "ArrowFunction": {
                        "is_static": false,
                        "by_ref": false,
                        "params": [
                          {
                            "name": "x",
                            "type_hint": null,
                            "default": null,
                            "by_ref": false,
                            "variadic": false,
                            "is_readonly": false,
                            "is_final": false,
                            "visibility": null,
                            "set_visibility": null,
                            "attributes": [],
                            "span": {
                              "start": 105,
                              "end": 107
                            }
                          }
                        ],
                        "return_type": null,
                        "body": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 112,
                                  "end": 114
                                }
                              },
                              "op": "Mul",
                              "right": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 117,
                                  "end": 118
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 112,
                            "end": 118
                          }
                        },
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 102,
                      "end": 118
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 92,
                    "end": 118
                  }
                },
                {
                  "name": {
                    "name": "array",
                    "span": {
                      "start": 120,
                      "end": 125
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "arr"
                    },
                    "span": {
                      "start": 127,
                      "end": 131
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 120,
                    "end": 131
                  }
                }
              ]
            }
          },
          "span": {
            "start": 82,
            "end": 132
          }
        }
      },
      "span": {
        "start": 82,
        "end": 133
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}

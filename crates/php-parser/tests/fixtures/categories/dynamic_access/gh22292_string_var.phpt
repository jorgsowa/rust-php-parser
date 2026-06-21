===source===
<?php
${'---'} = 'abc';
var_dump(${'---'});
assert(!${'---'});
$f = new Foo();
var_dump($f->{'---'});
assert(!$f->{'---'});
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
                  "VariableVariable": {
                    "kind": {
                      "String": "---"
                    },
                    "span": {
                      "start": 8,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "abc"
                },
                "span": {
                  "start": 17,
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
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "var_dump"
                },
                "span": {
                  "start": 24,
                  "end": 32
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "String": "---"
                        },
                        "span": {
                          "start": 35,
                          "end": 40
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 41
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 33,
                    "end": 41
                  }
                }
              ]
            }
          },
          "span": {
            "start": 24,
            "end": 42
          }
        }
      },
      "span": {
        "start": 24,
        "end": 43
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "assert"
                },
                "span": {
                  "start": 44,
                  "end": 50
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "BooleanNot",
                        "operand": {
                          "kind": {
                            "VariableVariable": {
                              "kind": {
                                "String": "---"
                              },
                              "span": {
                                "start": 54,
                                "end": 59
                              }
                            }
                          },
                          "span": {
                            "start": 52,
                            "end": 60
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 60
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 51,
                    "end": 60
                  }
                }
              ]
            }
          },
          "span": {
            "start": 44,
            "end": 61
          }
        }
      },
      "span": {
        "start": 44,
        "end": 62
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
                  "start": 63,
                  "end": 65
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 72,
                        "end": 75
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 68,
                  "end": 77
                }
              }
            }
          },
          "span": {
            "start": 63,
            "end": 77
          }
        }
      },
      "span": {
        "start": 63,
        "end": 78
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "var_dump"
                },
                "span": {
                  "start": 79,
                  "end": 87
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "Variable": "f"
                          },
                          "span": {
                            "start": 88,
                            "end": 90
                          }
                        },
                        "property": {
                          "kind": {
                            "String": "---"
                          },
                          "span": {
                            "start": 93,
                            "end": 98
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 88,
                      "end": 98
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 88,
                    "end": 98
                  }
                }
              ]
            }
          },
          "span": {
            "start": 79,
            "end": 100
          }
        }
      },
      "span": {
        "start": 79,
        "end": 101
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "assert"
                },
                "span": {
                  "start": 102,
                  "end": 108
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "BooleanNot",
                        "operand": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "f"
                                },
                                "span": {
                                  "start": 110,
                                  "end": 112
                                }
                              },
                              "property": {
                                "kind": {
                                  "String": "---"
                                },
                                "span": {
                                  "start": 115,
                                  "end": 120
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 110,
                            "end": 120
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 109,
                      "end": 120
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 109,
                    "end": 120
                  }
                }
              ]
            }
          },
          "span": {
            "start": 102,
            "end": 122
          }
        }
      },
      "span": {
        "start": 102,
        "end": 123
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 123
  }
}

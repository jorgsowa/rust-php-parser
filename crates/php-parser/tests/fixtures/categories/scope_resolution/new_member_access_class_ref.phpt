===config===
min_php=8.1
===source===
<?php
$x = new $this->job();
$y = new $obj->factory->type();
$z = new $arr['cls']();
$w = new $a::$b();
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "this"
                            },
                            "span": {
                              "start": 15,
                              "end": 20
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "job"
                            },
                            "span": {
                              "start": 22,
                              "end": 25
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 25
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 27
                }
              }
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
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 29,
                  "end": 31
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "PropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Variable": "obj"
                                  },
                                  "span": {
                                    "start": 38,
                                    "end": 42
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "factory"
                                  },
                                  "span": {
                                    "start": 44,
                                    "end": 51
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 38,
                              "end": 51
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "type"
                            },
                            "span": {
                              "start": 53,
                              "end": 57
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 38,
                        "end": 57
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 34,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 29,
            "end": 59
          }
        }
      },
      "span": {
        "start": 29,
        "end": 60
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 61,
                  "end": 63
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "arr"
                            },
                            "span": {
                              "start": 70,
                              "end": 74
                            }
                          },
                          "index": {
                            "kind": {
                              "String": "cls"
                            },
                            "span": {
                              "start": 75,
                              "end": 80
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 81
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 66,
                  "end": 83
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 83
          }
        }
      },
      "span": {
        "start": 61,
        "end": 84
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "w"
                },
                "span": {
                  "start": 85,
                  "end": 87
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "StaticPropertyAccess": {
                          "class": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 94,
                              "end": 96
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 98,
                              "end": 100
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 94,
                        "end": 100
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 90,
                  "end": 102
                }
              }
            }
          },
          "span": {
            "start": 85,
            "end": 102
          }
        }
      },
      "span": {
        "start": 85,
        "end": 103
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 103
  }
}

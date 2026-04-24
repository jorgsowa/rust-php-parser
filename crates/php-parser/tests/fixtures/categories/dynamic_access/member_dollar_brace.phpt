===source===
<?php
$oa->${f()} = g();
$ob->o1->${f()} = g();
C::${f()} = g();
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "oa"
                      },
                      "span": {
                        "start": 6,
                        "end": 9
                      }
                    },
                    "property": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Identifier": "f"
                                },
                                "span": {
                                  "start": 13,
                                  "end": 14
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 13,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "g"
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "ob"
                            },
                            "span": {
                              "start": 25,
                              "end": 28
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "o1"
                            },
                            "span": {
                              "start": 30,
                              "end": 32
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 32
                      }
                    },
                    "property": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Identifier": "f"
                                },
                                "span": {
                                  "start": 36,
                                  "end": 37
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 36,
                            "end": 39
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 40
                      }
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 40
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "g"
                      },
                      "span": {
                        "start": 43,
                        "end": 44
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 43,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 46
          }
        }
      },
      "span": {
        "start": 25,
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
                  "StaticPropertyAccessDynamic": {
                    "class": {
                      "kind": {
                        "Identifier": "C"
                      },
                      "span": {
                        "start": 48,
                        "end": 49
                      }
                    },
                    "member": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Identifier": "f"
                                },
                                "span": {
                                  "start": 53,
                                  "end": 54
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 53,
                            "end": 56
                          }
                        }
                      },
                      "span": {
                        "start": 51,
                        "end": 57
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 57
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "g"
                      },
                      "span": {
                        "start": 60,
                        "end": 61
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 60,
                  "end": 63
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 63
          }
        }
      },
      "span": {
        "start": 48,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}

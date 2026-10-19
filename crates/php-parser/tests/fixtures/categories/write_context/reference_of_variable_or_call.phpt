===source===
<?php
$a = &$$b;
$a = &A::b();
$a = &f()->x;
$a = &$b[0]->c;
[&$a] = f();
[&$a] = $b->c();
[&$a] = A::$b;
[[&$a]] = ($b);
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
                  "VariableVariable": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 13,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 15
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
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
                  "start": 17,
                  "end": 19
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
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 24
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 26,
                        "end": 27
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 23,
                  "end": 29
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 17,
            "end": 29
          }
        }
      },
      "span": {
        "start": 17,
        "end": 30
      }
    },
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
                  "start": 31,
                  "end": 33
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
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
                                  "start": 37,
                                  "end": 38
                                }
                              }
                            },
                            "span": {
                              "start": 37,
                              "end": 38
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 40
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "x"
                      },
                      "span": {
                        "start": 42,
                        "end": 43
                      }
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 43
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 31,
            "end": 43
          }
        }
      },
      "span": {
        "start": 31,
        "end": 44
      }
    },
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
                  "start": 45,
                  "end": 47
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 51,
                              "end": 53
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 54,
                              "end": 55
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 51,
                        "end": 56
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 58,
                        "end": 59
                      }
                    }
                  }
                },
                "span": {
                  "start": 51,
                  "end": 59
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 45,
            "end": 59
          }
        }
      },
      "span": {
        "start": 45,
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 63,
                            "end": 65
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 65
                      }
                    }
                  ]
                },
                "span": {
                  "start": 61,
                  "end": 66
                }
              },
              "op": "Assign",
              "value": {
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
                            "start": 69,
                            "end": 70
                          }
                        }
                      },
                      "span": {
                        "start": 69,
                        "end": 70
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 69,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 72
          }
        }
      },
      "span": {
        "start": 61,
        "end": 73
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 76,
                            "end": 78
                          }
                        }
                      },
                      "span": {
                        "start": 75,
                        "end": 78
                      }
                    }
                  ]
                },
                "span": {
                  "start": 74,
                  "end": 79
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 82,
                        "end": 84
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 86,
                        "end": 87
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 82,
                  "end": 89
                }
              }
            }
          },
          "span": {
            "start": 74,
            "end": 89
          }
        }
      },
      "span": {
        "start": 74,
        "end": 90
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 93,
                            "end": 95
                          }
                        }
                      },
                      "span": {
                        "start": 92,
                        "end": 95
                      }
                    }
                  ]
                },
                "span": {
                  "start": 91,
                  "end": 96
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
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 99,
                            "end": 100
                          }
                        }
                      },
                      "span": {
                        "start": 99,
                        "end": 100
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 102,
                        "end": 104
                      }
                    }
                  }
                },
                "span": {
                  "start": 99,
                  "end": 104
                }
              }
            }
          },
          "span": {
            "start": 91,
            "end": 104
          }
        }
      },
      "span": {
        "start": 91,
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "ByRef": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 109,
                                      "end": 111
                                    }
                                  }
                                },
                                "span": {
                                  "start": 108,
                                  "end": 111
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 107,
                            "end": 112
                          }
                        }
                      },
                      "span": {
                        "start": 107,
                        "end": 112
                      }
                    }
                  ]
                },
                "span": {
                  "start": 106,
                  "end": 113
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 117,
                      "end": 119
                    }
                  }
                },
                "span": {
                  "start": 116,
                  "end": 120
                }
              }
            }
          },
          "span": {
            "start": 106,
            "end": 120
          }
        }
      },
      "span": {
        "start": 106,
        "end": 121
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 121
  }
}

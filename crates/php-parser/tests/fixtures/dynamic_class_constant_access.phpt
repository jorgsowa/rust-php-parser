===config===
min_php=8.3
===source===
<?php
$a = Foo::{$name};
$b = Foo::{'CONST_' . $suffix};
$c = $class::$$dynamic;
$d = $class::${'prop_' . $name};
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
                  "ClassConstAccessDynamic": {
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
                    "member": {
                      "kind": {
                        "Variable": "name"
                      },
                      "span": {
                        "start": 17,
                        "end": 22,
                        "start_line": 2,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 23,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
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
                  "start": 25,
                  "end": 27,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccessDynamic": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 30,
                        "end": 33,
                        "start_line": 3,
                        "start_col": 5
                      }
                    },
                    "member": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "String": "CONST_"
                            },
                            "span": {
                              "start": 36,
                              "end": 44,
                              "start_line": 3,
                              "start_col": 11
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "Variable": "suffix"
                            },
                            "span": {
                              "start": 47,
                              "end": 54,
                              "start_line": 3,
                              "start_col": 22
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 54,
                        "start_line": 3,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 55,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 55,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 57,
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
                  "start": 57,
                  "end": 59,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticPropertyAccessDynamic": {
                    "class": {
                      "kind": {
                        "Variable": "class"
                      },
                      "span": {
                        "start": 62,
                        "end": 68,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    "member": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "Variable": "dynamic"
                          },
                          "span": {
                            "start": 71,
                            "end": 79,
                            "start_line": 4,
                            "start_col": 14
                          }
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 79,
                        "start_line": 4,
                        "start_col": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 79,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 57,
            "end": 79,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 57,
        "end": 81,
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
                  "start": 81,
                  "end": 83,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticPropertyAccessDynamic": {
                    "class": {
                      "kind": {
                        "Variable": "class"
                      },
                      "span": {
                        "start": 86,
                        "end": 92,
                        "start_line": 5,
                        "start_col": 5
                      }
                    },
                    "member": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "String": "prop_"
                                },
                                "span": {
                                  "start": 96,
                                  "end": 103,
                                  "start_line": 5,
                                  "start_col": 15
                                }
                              },
                              "op": "Concat",
                              "right": {
                                "kind": {
                                  "Variable": "name"
                                },
                                "span": {
                                  "start": 106,
                                  "end": 111,
                                  "start_line": 5,
                                  "start_col": 25
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 96,
                            "end": 111,
                            "start_line": 5,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 94,
                        "end": 111,
                        "start_line": 5,
                        "start_col": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 86,
                  "end": 111,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 81,
            "end": 111,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 81,
        "end": 113,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113,
    "start_line": 1,
    "start_col": 0
  }
}

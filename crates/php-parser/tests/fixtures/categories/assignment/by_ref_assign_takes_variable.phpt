===source===
<?php
$a = &$b + $c;
$x = $a = &$b . "s";
$d = &f() && $e;
$g = &$h->i()[0]::$j;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
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
                        "Variable": "b"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "by_ref": true
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 17,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
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
                  "start": 21,
                  "end": 23
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 26,
                              "end": 28
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 32,
                              "end": 34
                            }
                          },
                          "by_ref": true
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 34
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "s"
                      },
                      "span": {
                        "start": 37,
                        "end": 40
                      }
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 40
          }
        }
      },
      "span": {
        "start": 21,
        "end": 41
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 42,
                        "end": 44
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
                                  "start": 48,
                                  "end": 49
                                }
                              }
                            },
                            "span": {
                              "start": 48,
                              "end": 49
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 48,
                        "end": 51
                      }
                    },
                    "by_ref": true
                  }
                },
                "span": {
                  "start": 42,
                  "end": 51
                }
              },
              "op": "BooleanAnd",
              "right": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 55,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 57
          }
        }
      },
      "span": {
        "start": 42,
        "end": 58
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 59,
                  "end": 61
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "MethodCall": {
                                "object": {
                                  "kind": {
                                    "Variable": "h"
                                  },
                                  "span": {
                                    "start": 65,
                                    "end": 67
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "i"
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
                              "start": 65,
                              "end": 72
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 73,
                              "end": 74
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 65,
                        "end": 75
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "j"
                      },
                      "span": {
                        "start": 77,
                        "end": 79
                      }
                    }
                  }
                },
                "span": {
                  "start": 65,
                  "end": 79
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 59,
            "end": 79
          }
        }
      },
      "span": {
        "start": 59,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}

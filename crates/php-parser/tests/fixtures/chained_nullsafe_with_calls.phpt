===source===
<?php
$x = $a?->b?->c?->d;
$y = $a?->getB()?->getC(1, 2)?->value;
$z = $a?->items[0]?->name;
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
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "NullsafePropertyAccess": {
                          "object": {
                            "kind": {
                              "NullsafePropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 11,
                                    "end": 13,
                                    "start_line": 2,
                                    "start_col": 5
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "b"
                                  },
                                  "span": {
                                    "start": 16,
                                    "end": 17,
                                    "start_line": 2,
                                    "start_col": 10
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 11,
                              "end": 17,
                              "start_line": 2,
                              "start_col": 5
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "c"
                            },
                            "span": {
                              "start": 20,
                              "end": 21,
                              "start_line": 2,
                              "start_col": 14
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 21,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "d"
                      },
                      "span": {
                        "start": 24,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 25,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
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
                  "Variable": "y"
                },
                "span": {
                  "start": 27,
                  "end": 29,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "NullsafeMethodCall": {
                          "object": {
                            "kind": {
                              "NullsafeMethodCall": {
                                "object": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 32,
                                    "end": 34,
                                    "start_line": 3,
                                    "start_col": 5
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "getB"
                                  },
                                  "span": {
                                    "start": 37,
                                    "end": 41,
                                    "start_line": 3,
                                    "start_col": 10
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 32,
                              "end": 43,
                              "start_line": 3,
                              "start_col": 5
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "getC"
                            },
                            "span": {
                              "start": 46,
                              "end": 50,
                              "start_line": 3,
                              "start_col": 19
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
                                  "start": 51,
                                  "end": 52,
                                  "start_line": 3,
                                  "start_col": 24
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 51,
                                "end": 52,
                                "start_line": 3,
                                "start_col": 24
                              }
                            },
                            {
                              "name": null,
                              "value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 54,
                                  "end": 55,
                                  "start_line": 3,
                                  "start_col": 27
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 54,
                                "end": 55,
                                "start_line": 3,
                                "start_col": 27
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 56,
                        "start_line": 3,
                        "start_col": 5
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "value"
                      },
                      "span": {
                        "start": 59,
                        "end": 64,
                        "start_line": 3,
                        "start_col": 32
                      }
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 64,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 64,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 27,
        "end": 66,
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
                  "Variable": "z"
                },
                "span": {
                  "start": 66,
                  "end": 68,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "NullsafePropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 71,
                                    "end": 73,
                                    "start_line": 4,
                                    "start_col": 5
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "items"
                                  },
                                  "span": {
                                    "start": 76,
                                    "end": 81,
                                    "start_line": 4,
                                    "start_col": 10
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 71,
                              "end": 81,
                              "start_line": 4,
                              "start_col": 5
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 82,
                              "end": 83,
                              "start_line": 4,
                              "start_col": 16
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 71,
                        "end": 84,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "name"
                      },
                      "span": {
                        "start": 87,
                        "end": 91,
                        "start_line": 4,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 71,
                  "end": 91,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 91,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 66,
        "end": 92,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92,
    "start_line": 1,
    "start_col": 0
  }
}

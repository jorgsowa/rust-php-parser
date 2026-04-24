===source===
<?php
$a = "{$arr["outer"]["inner"]}";
$b = "prefix {$obj["key"]}";
$c = "x: {$map[$inner["nested"]]}";
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
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "ArrayAccess": {
                                  "array": {
                                    "kind": {
                                      "Variable": "arr"
                                    },
                                    "span": {
                                      "start": 13,
                                      "end": 17
                                    }
                                  },
                                  "index": {
                                    "kind": {
                                      "String": "outer"
                                    },
                                    "span": {
                                      "start": 18,
                                      "end": 25
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 13,
                                "end": 26
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "inner"
                              },
                              "span": {
                                "start": 27,
                                "end": 34
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 35
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 37
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
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
                  "start": 39,
                  "end": 41
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "prefix "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 53,
                                "end": 57
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "key"
                              },
                              "span": {
                                "start": 58,
                                "end": 63
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 53,
                          "end": 64
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 44,
                  "end": 66
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 66
          }
        }
      },
      "span": {
        "start": 39,
        "end": 67
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
                  "start": 68,
                  "end": 70
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "x: "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "map"
                              },
                              "span": {
                                "start": 78,
                                "end": 82
                              }
                            },
                            "index": {
                              "kind": {
                                "ArrayAccess": {
                                  "array": {
                                    "kind": {
                                      "Variable": "inner"
                                    },
                                    "span": {
                                      "start": 83,
                                      "end": 89
                                    }
                                  },
                                  "index": {
                                    "kind": {
                                      "String": "nested"
                                    },
                                    "span": {
                                      "start": 90,
                                      "end": 98
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 83,
                                "end": 99
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 78,
                          "end": 100
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 73,
                  "end": 102
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 102
          }
        }
      },
      "span": {
        "start": 68,
        "end": 103
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 103
  }
}

===source===
<?php
[&$a] = $b;
list(&$a) = $b;
[$a, [&$b]] = $c;
$a = &$b;
$a = &f();
[$a] = $b;
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 8,
                            "end": 10
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 10
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 14,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
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
                            "start": 24,
                            "end": 26
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 26
                      }
                    }
                  ]
                },
                "span": {
                  "start": 18,
                  "end": 27
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 30,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 18,
            "end": 32
          }
        }
      },
      "span": {
        "start": 18,
        "end": 33
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
                            "Variable": "a"
                          },
                          "span": {
                            "start": 35,
                            "end": 37
                          }
                        }
                      },
                      "span": {
                        "start": 35,
                        "end": 37
                      }
                    },
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
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 41,
                                      "end": 43
                                    }
                                  }
                                },
                                "span": {
                                  "start": 40,
                                  "end": 43
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 39,
                            "end": 44
                          }
                        }
                      },
                      "span": {
                        "start": 39,
                        "end": 44
                      }
                    }
                  ]
                },
                "span": {
                  "start": 34,
                  "end": 45
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 48,
                  "end": 50
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 50
          }
        }
      },
      "span": {
        "start": 34,
        "end": 51
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
                  "start": 52,
                  "end": 54
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 58,
                  "end": 60
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 52,
            "end": 60
          }
        }
      },
      "span": {
        "start": 52,
        "end": 61
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
                  "start": 62,
                  "end": 64
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
                            "start": 68,
                            "end": 69
                          }
                        }
                      },
                      "span": {
                        "start": 68,
                        "end": 69
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 68,
                  "end": 71
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 62,
            "end": 71
          }
        }
      },
      "span": {
        "start": 62,
        "end": 72
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
                            "Variable": "a"
                          },
                          "span": {
                            "start": 74,
                            "end": 76
                          }
                        }
                      },
                      "span": {
                        "start": 74,
                        "end": 76
                      }
                    }
                  ]
                },
                "span": {
                  "start": 73,
                  "end": 77
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 80,
                  "end": 82
                }
              }
            }
          },
          "span": {
            "start": 73,
            "end": 82
          }
        }
      },
      "span": {
        "start": 73,
        "end": 83
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 83
  }
}

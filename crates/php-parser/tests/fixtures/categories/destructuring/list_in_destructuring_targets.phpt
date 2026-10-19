===source===
<?php
list($a, list($b)) = $c;
$x = list($a) = $b;
foreach ($a as $k => list($b, $c)) {}
f(list("k" => $a) = $b);
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
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 11,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 13
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
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 20,
                                      "end": 22
                                    }
                                  }
                                },
                                "span": {
                                  "start": 20,
                                  "end": 22
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 15,
                            "end": 23
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 23
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 24
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 27,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
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
                  "Variable": "x"
                },
                "span": {
                  "start": 31,
                  "end": 33
                }
              },
              "op": "Assign",
              "value": {
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
                                  "start": 41,
                                  "end": 43
                                }
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 43
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 36,
                        "end": 44
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 47,
                        "end": 49
                      }
                    }
                  }
                },
                "span": {
                  "start": 36,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 31,
            "end": 49
          }
        }
      },
      "span": {
        "start": 31,
        "end": 50
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 60,
              "end": 62
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 66,
              "end": 68
            }
          },
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 77,
                        "end": 79
                      }
                    }
                  },
                  "span": {
                    "start": 77,
                    "end": 79
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 81,
                        "end": 83
                      }
                    }
                  },
                  "span": {
                    "start": 81,
                    "end": 83
                  }
                }
              ]
            },
            "span": {
              "start": 72,
              "end": 84
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 86,
              "end": 88
            }
          }
        }
      },
      "span": {
        "start": 51,
        "end": 88
      }
    },
    {
      "kind": {
        "Expression": {
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
                      "start": 89,
                      "end": 90
                    }
                  }
                },
                "span": {
                  "start": 89,
                  "end": 90
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Array": [
                                {
                                  "key": {
                                    "kind": {
                                      "String": "k"
                                    },
                                    "span": {
                                      "start": 96,
                                      "end": 99
                                    }
                                  },
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 103,
                                        "end": 105
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 96,
                                    "end": 105
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 91,
                              "end": 106
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 109,
                              "end": 111
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 111
                      }
                    }
                  },
                  "span": {
                    "start": 91,
                    "end": 111
                  }
                }
              ]
            }
          },
          "span": {
            "start": 89,
            "end": 112
          }
        }
      },
      "span": {
        "start": 89,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}

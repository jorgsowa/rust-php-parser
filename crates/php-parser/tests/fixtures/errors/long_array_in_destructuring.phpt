===source===
<?php
[array($a)] = $b;
list(array($a)) = $b;
[[$x, ARRAY($a)], list($c)] = $b;
['k' => array($a)] = $b;
foreach ($x as [array($a)]) {}
===errors===
Cannot assign to array(), use [] instead
Cannot assign to array(), use [] instead
Cannot assign to array(), use [] instead
Cannot assign to array(), use [] instead
Cannot assign to array(), use [] instead
===php_error===
PHP Fatal error:  Cannot assign to array(), use [] instead in Standard input code on line 2
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
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 13,
                                      "end": 15
                                    }
                                  }
                                },
                                "span": {
                                  "start": 13,
                                  "end": 15
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 7,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 20,
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
                              }
                            ]
                          },
                          "span": {
                            "start": 29,
                            "end": 38
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 38
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 39
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 42,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 44
          }
        }
      },
      "span": {
        "start": 24,
        "end": 45
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
                                  "Value": {
                                    "kind": {
                                      "Variable": "x"
                                    },
                                    "span": {
                                      "start": 48,
                                      "end": 50
                                    }
                                  }
                                },
                                "span": {
                                  "start": 48,
                                  "end": 50
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
                                                "Variable": "a"
                                              },
                                              "span": {
                                                "start": 58,
                                                "end": 60
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 58,
                                            "end": 60
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 52,
                                      "end": 61
                                    }
                                  }
                                },
                                "span": {
                                  "start": 52,
                                  "end": 61
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 47,
                            "end": 62
                          }
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 62
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
                                      "Variable": "c"
                                    },
                                    "span": {
                                      "start": 69,
                                      "end": 71
                                    }
                                  }
                                },
                                "span": {
                                  "start": 69,
                                  "end": 71
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 64,
                            "end": 72
                          }
                        }
                      },
                      "span": {
                        "start": 64,
                        "end": 72
                      }
                    }
                  ]
                },
                "span": {
                  "start": 46,
                  "end": 73
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 76,
                  "end": 78
                }
              }
            }
          },
          "span": {
            "start": 46,
            "end": 78
          }
        }
      },
      "span": {
        "start": 46,
        "end": 79
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
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 81,
                          "end": 84
                        }
                      },
                      "kind": {
                        "Value": {
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
                                      "start": 94,
                                      "end": 96
                                    }
                                  }
                                },
                                "span": {
                                  "start": 94,
                                  "end": 96
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 88,
                            "end": 97
                          }
                        }
                      },
                      "span": {
                        "start": 81,
                        "end": 97
                      }
                    }
                  ]
                },
                "span": {
                  "start": 80,
                  "end": 98
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 101,
                  "end": 103
                }
              }
            }
          },
          "span": {
            "start": 80,
            "end": 103
          }
        }
      },
      "span": {
        "start": 80,
        "end": 104
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 114,
              "end": 116
            }
          },
          "key": null,
          "value": {
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
                              "Value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 127,
                                  "end": 129
                                }
                              }
                            },
                            "span": {
                              "start": 127,
                              "end": 129
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 121,
                        "end": 130
                      }
                    }
                  },
                  "span": {
                    "start": 121,
                    "end": 130
                  }
                }
              ]
            },
            "span": {
              "start": 120,
              "end": 131
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 133,
              "end": 135
            }
          }
        }
      },
      "span": {
        "start": 105,
        "end": 135
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 135
  }
}

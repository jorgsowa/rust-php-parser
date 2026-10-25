===source===
<?php
$a = [$k => 1, ...2];
$a = [...FOO];
$a = [...$b, ...1];
$a = [&$c, ...1];
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "Variable": "k"
                        },
                        "span": {
                          "start": 12,
                          "end": 14
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 18,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 19
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 24,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 25
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
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
                  "start": 28,
                  "end": 30
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "FOO"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 37,
                                "end": 40
                              }
                            }
                          },
                          "span": {
                            "start": 37,
                            "end": 40
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 40
                      }
                    }
                  ]
                },
                "span": {
                  "start": 33,
                  "end": 41
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 41
          }
        }
      },
      "span": {
        "start": 28,
        "end": 42
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
                  "start": 43,
                  "end": 45
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 52,
                            "end": 54
                          }
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 54
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 59,
                            "end": 60
                          }
                        }
                      },
                      "span": {
                        "start": 56,
                        "end": 60
                      }
                    }
                  ]
                },
                "span": {
                  "start": 48,
                  "end": 61
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 61
          }
        }
      },
      "span": {
        "start": 43,
        "end": 62
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
                  "start": 63,
                  "end": 65
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 70,
                            "end": 72
                          }
                        }
                      },
                      "span": {
                        "start": 69,
                        "end": 72
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 77,
                            "end": 78
                          }
                        }
                      },
                      "span": {
                        "start": 74,
                        "end": 78
                      }
                    }
                  ]
                },
                "span": {
                  "start": 68,
                  "end": 79
                }
              }
            }
          },
          "span": {
            "start": 63,
            "end": 79
          }
        }
      },
      "span": {
        "start": 63,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}

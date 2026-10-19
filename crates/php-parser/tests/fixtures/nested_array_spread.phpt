===source===
<?php
$arrays = [[1, 2], [3, 4]];
$flat = [...$arrays[0], ...$arrays[1], 5];
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
                  "Variable": "arrays"
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Assign",
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
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 18,
                                      "end": 19
                                    }
                                  }
                                },
                                "span": {
                                  "start": 18,
                                  "end": 19
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 21,
                                      "end": 22
                                    }
                                  }
                                },
                                "span": {
                                  "start": 21,
                                  "end": 22
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 17,
                            "end": 23
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 23
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
                                      "Int": 3
                                    },
                                    "span": {
                                      "start": 26,
                                      "end": 27
                                    }
                                  }
                                },
                                "span": {
                                  "start": 26,
                                  "end": 27
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 4
                                    },
                                    "span": {
                                      "start": 29,
                                      "end": 30
                                    }
                                  }
                                },
                                "span": {
                                  "start": 29,
                                  "end": 30
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 25,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 31
                      }
                    }
                  ]
                },
                "span": {
                  "start": 16,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
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
                  "Variable": "flat"
                },
                "span": {
                  "start": 34,
                  "end": 39
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
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "arrays"
                                },
                                "span": {
                                  "start": 46,
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
                            "start": 46,
                            "end": 56
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 56
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "arrays"
                                },
                                "span": {
                                  "start": 61,
                                  "end": 68
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 69,
                                  "end": 70
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 61,
                            "end": 71
                          }
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 71
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 5
                          },
                          "span": {
                            "start": 73,
                            "end": 74
                          }
                        }
                      },
                      "span": {
                        "start": 73,
                        "end": 74
                      }
                    }
                  ]
                },
                "span": {
                  "start": 42,
                  "end": 75
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 75
          }
        }
      },
      "span": {
        "start": 34,
        "end": 76
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76
  }
}

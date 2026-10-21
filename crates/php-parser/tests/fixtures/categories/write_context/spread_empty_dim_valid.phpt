===source===
<?php
f($a[]);
f(...$a[0]);
f(...$a["x"][1]);
===ast===
{
  "stmts": [
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
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 8,
                              "end": 10
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 8,
                        "end": 12
                      }
                    }
                  },
                  "span": {
                    "start": 8,
                    "end": 12
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 13
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
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
                      "start": 15,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 15,
                  "end": 16
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 20,
                              "end": 22
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 23,
                              "end": 24
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 25
                  }
                }
              ]
            }
          },
          "span": {
            "start": 15,
            "end": 26
          }
        }
      },
      "span": {
        "start": 15,
        "end": 27
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
                      "start": 28,
                      "end": 29
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 29
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 33,
                                    "end": 35
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "String": "x"
                                  },
                                  "span": {
                                    "start": 36,
                                    "end": 39
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 33,
                              "end": 40
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 41,
                              "end": 42
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 43
                      }
                    }
                  },
                  "span": {
                    "start": 30,
                    "end": 43
                  }
                }
              ]
            }
          },
          "span": {
            "start": 28,
            "end": 44
          }
        }
      },
      "span": {
        "start": 28,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}

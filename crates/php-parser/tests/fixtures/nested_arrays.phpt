===source===
<?php [[1, 2], [3, 4]]; ['a' => ['x' => 1], 'b' => ['y' => 2]];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
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
                                "start": 8,
                                "end": 9
                              }
                            }
                          },
                          "span": {
                            "start": 8,
                            "end": 9
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
                                "start": 11,
                                "end": 12
                              }
                            }
                          },
                          "span": {
                            "start": 11,
                            "end": 12
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 7,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 7,
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
                                "Int": 3
                              },
                              "span": {
                                "start": 16,
                                "end": 17
                              }
                            }
                          },
                          "span": {
                            "start": 16,
                            "end": 17
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
                                "start": 19,
                                "end": 20
                              }
                            }
                          },
                          "span": {
                            "start": 19,
                            "end": 20
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 15,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 15,
                  "end": 21
                }
              }
            ]
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
            "Array": [
              {
                "key": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 25,
                    "end": 28
                  }
                },
                "kind": {
                  "Value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "x"
                            },
                            "span": {
                              "start": 33,
                              "end": 36
                            }
                          },
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 40,
                                "end": 41
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 41
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 32,
                      "end": 42
                    }
                  }
                },
                "span": {
                  "start": 25,
                  "end": 42
                }
              },
              {
                "key": {
                  "kind": {
                    "String": "b"
                  },
                  "span": {
                    "start": 44,
                    "end": 47
                  }
                },
                "kind": {
                  "Value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "y"
                            },
                            "span": {
                              "start": 52,
                              "end": 55
                            }
                          },
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 2
                              },
                              "span": {
                                "start": 59,
                                "end": 60
                              }
                            }
                          },
                          "span": {
                            "start": 52,
                            "end": 60
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 51,
                      "end": 61
                    }
                  }
                },
                "span": {
                  "start": 44,
                  "end": 61
                }
              }
            ]
          },
          "span": {
            "start": 24,
            "end": 62
          }
        }
      },
      "span": {
        "start": 24,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}

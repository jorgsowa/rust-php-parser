===config===
max_php=8.4
===source===
<?php
list($a, [[$b, $c]]) = [[1, [2, 3]]];
[$x, [$y, $z]] = $data;
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
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 11,
                          "end": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "b"
                                        },
                                        "span": {
                                          "start": 17,
                                          "end": 19
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 17,
                                        "end": 19
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "c"
                                        },
                                        "span": {
                                          "start": 21,
                                          "end": 23
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 21,
                                        "end": 23
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 16,
                                  "end": 24
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 16,
                                "end": 24
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 15,
                          "end": 25
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 25
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 26
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 31,
                                  "end": 32
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 31,
                                "end": 32
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 2
                                        },
                                        "span": {
                                          "start": 35,
                                          "end": 36
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 35,
                                        "end": 36
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 3
                                        },
                                        "span": {
                                          "start": 38,
                                          "end": 39
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 38,
                                        "end": 39
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 34,
                                  "end": 40
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 34,
                                "end": 40
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 30,
                          "end": 41
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 30,
                        "end": 41
                      }
                    }
                  ]
                },
                "span": {
                  "start": 29,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 42
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43
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
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 45,
                          "end": 47
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 45,
                        "end": 47
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "y"
                                },
                                "span": {
                                  "start": 50,
                                  "end": 52
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 50,
                                "end": 52
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "z"
                                },
                                "span": {
                                  "start": 54,
                                  "end": 56
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 54,
                                "end": 56
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 49,
                          "end": 57
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 49,
                        "end": 57
                      }
                    }
                  ]
                },
                "span": {
                  "start": 44,
                  "end": 58
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "data"
                },
                "span": {
                  "start": 61,
                  "end": 66
                }
              }
            }
          },
          "span": {
            "start": 44,
            "end": 66
          }
        }
      },
      "span": {
        "start": 44,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
===php_error===
PHP Fatal error:  Cannot mix [] and list() in Standard input code on line 2

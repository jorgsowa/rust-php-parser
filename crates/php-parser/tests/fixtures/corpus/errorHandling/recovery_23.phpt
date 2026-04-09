===source===
<?php
$array = [
    $this->value $oopsAnotherValue->get()
];
$array = [
    $value $oopsAnotherValue
];
$array = [
    'key' => $value $oopsAnotherValue
];
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
                  "Variable": "array"
                },
                "span": {
                  "start": 6,
                  "end": 12,
                  "start_line": 2,
                  "start_col": 0
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
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "this"
                              },
                              "span": {
                                "start": 21,
                                "end": 26,
                                "start_line": 3,
                                "start_col": 4
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "value"
                              },
                              "span": {
                                "start": 28,
                                "end": 33,
                                "start_line": 3,
                                "start_col": 11
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 33,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 21,
                        "end": 33,
                        "start_line": 3,
                        "start_col": 4
                      }
                    }
                  ]
                },
                "span": {
                  "start": 15,
                  "end": 34,
                  "start_line": 2,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "oopsAnotherValue"
                },
                "span": {
                  "start": 34,
                  "end": 51,
                  "start_line": 3,
                  "start_col": 17
                }
              },
              "method": {
                "kind": {
                  "Identifier": "get"
                },
                "span": {
                  "start": 53,
                  "end": 56,
                  "start_line": 3,
                  "start_col": 36
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 34,
            "end": 59,
            "start_line": 3,
            "start_col": 17
          }
        }
      },
      "span": {
        "start": 34,
        "end": 59,
        "start_line": 3,
        "start_col": 17
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 59,
        "end": 62,
        "start_line": 4,
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
                  "Variable": "array"
                },
                "span": {
                  "start": 62,
                  "end": 68,
                  "start_line": 5,
                  "start_col": 0
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
                          "Variable": "value"
                        },
                        "span": {
                          "start": 77,
                          "end": 83,
                          "start_line": 6,
                          "start_col": 4
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 77,
                        "end": 83,
                        "start_line": 6,
                        "start_col": 4
                      }
                    }
                  ]
                },
                "span": {
                  "start": 71,
                  "end": 84,
                  "start_line": 5,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 62,
            "end": 84,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 62,
        "end": 84,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "oopsAnotherValue"
          },
          "span": {
            "start": 84,
            "end": 101,
            "start_line": 6,
            "start_col": 11
          }
        }
      },
      "span": {
        "start": 84,
        "end": 102,
        "start_line": 6,
        "start_col": 11
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 102,
        "end": 105,
        "start_line": 7,
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
                  "Variable": "array"
                },
                "span": {
                  "start": 105,
                  "end": 111,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "key"
                        },
                        "span": {
                          "start": 120,
                          "end": 125,
                          "start_line": 9,
                          "start_col": 4
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "value"
                        },
                        "span": {
                          "start": 129,
                          "end": 135,
                          "start_line": 9,
                          "start_col": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 120,
                        "end": 135,
                        "start_line": 9,
                        "start_col": 4
                      }
                    }
                  ]
                },
                "span": {
                  "start": 114,
                  "end": 136,
                  "start_line": 8,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 105,
            "end": 136,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 105,
        "end": 136,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "oopsAnotherValue"
          },
          "span": {
            "start": 136,
            "end": 153,
            "start_line": 9,
            "start_col": 20
          }
        }
      },
      "span": {
        "start": 136,
        "end": 154,
        "start_line": 9,
        "start_col": 20
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 154,
        "end": 156,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 156,
    "start_line": 1,
    "start_col": 0
  }
}

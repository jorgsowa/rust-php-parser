===source===
<?php
function fib($n) {
    if ($n <= 1) {
        return $n;
    }
    return fib($n - 1) + fib($n - 2);
}

$result = fib(10);
echo $result;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "fib",
          "params": [
            {
              "name": "n",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 21,
                "start_line": 2,
                "start_col": 13
              }
            }
          ],
          "body": [
            {
              "kind": {
                "If": {
                  "condition": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "n"
                          },
                          "span": {
                            "start": 33,
                            "end": 35,
                            "start_line": 3,
                            "start_col": 8
                          }
                        },
                        "op": "LessOrEqual",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 39,
                            "end": 40,
                            "start_line": 3,
                            "start_col": 14
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 40,
                      "start_line": 3,
                      "start_col": 8
                    }
                  },
                  "then_branch": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "Return": {
                              "kind": {
                                "Variable": "n"
                              },
                              "span": {
                                "start": 59,
                                "end": 61,
                                "start_line": 4,
                                "start_col": 15
                              }
                            }
                          },
                          "span": {
                            "start": 52,
                            "end": 67,
                            "start_line": 4,
                            "start_col": 8
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 42,
                      "end": 68,
                      "start_line": 3,
                      "start_col": 17
                    }
                  },
                  "elseif_branches": [],
                  "else_branch": null
                }
              },
              "span": {
                "start": 29,
                "end": 68,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Identifier": "fib"
                              },
                              "span": {
                                "start": 80,
                                "end": 83,
                                "start_line": 6,
                                "start_col": 11
                              }
                            },
                            "args": [
                              {
                                "name": null,
                                "value": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Variable": "n"
                                        },
                                        "span": {
                                          "start": 84,
                                          "end": 86,
                                          "start_line": 6,
                                          "start_col": 15
                                        }
                                      },
                                      "op": "Sub",
                                      "right": {
                                        "kind": {
                                          "Int": 1
                                        },
                                        "span": {
                                          "start": 89,
                                          "end": 90,
                                          "start_line": 6,
                                          "start_col": 20
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 84,
                                    "end": 90,
                                    "start_line": 6,
                                    "start_col": 15
                                  }
                                },
                                "unpack": false,
                                "by_ref": false,
                                "span": {
                                  "start": 84,
                                  "end": 90,
                                  "start_line": 6,
                                  "start_col": 15
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 80,
                          "end": 92,
                          "start_line": 6,
                          "start_col": 11
                        }
                      },
                      "op": "Add",
                      "right": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Identifier": "fib"
                              },
                              "span": {
                                "start": 94,
                                "end": 97,
                                "start_line": 6,
                                "start_col": 25
                              }
                            },
                            "args": [
                              {
                                "name": null,
                                "value": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Variable": "n"
                                        },
                                        "span": {
                                          "start": 98,
                                          "end": 100,
                                          "start_line": 6,
                                          "start_col": 29
                                        }
                                      },
                                      "op": "Sub",
                                      "right": {
                                        "kind": {
                                          "Int": 2
                                        },
                                        "span": {
                                          "start": 103,
                                          "end": 104,
                                          "start_line": 6,
                                          "start_col": 34
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 98,
                                    "end": 104,
                                    "start_line": 6,
                                    "start_col": 29
                                  }
                                },
                                "unpack": false,
                                "by_ref": false,
                                "span": {
                                  "start": 98,
                                  "end": 104,
                                  "start_line": 6,
                                  "start_col": 29
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 94,
                          "end": 105,
                          "start_line": 6,
                          "start_col": 25
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 80,
                    "end": 105,
                    "start_line": 6,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 73,
                "end": 107,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 108,
        "start_line": 2,
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
                  "Variable": "result"
                },
                "span": {
                  "start": 110,
                  "end": 117,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "fib"
                      },
                      "span": {
                        "start": 120,
                        "end": 123,
                        "start_line": 9,
                        "start_col": 10
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 10
                          },
                          "span": {
                            "start": 124,
                            "end": 126,
                            "start_line": 9,
                            "start_col": 14
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 124,
                          "end": 126,
                          "start_line": 9,
                          "start_col": 14
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 120,
                  "end": 127,
                  "start_line": 9,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 110,
            "end": 127,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 110,
        "end": 129,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "result"
            },
            "span": {
              "start": 134,
              "end": 141,
              "start_line": 10,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 129,
        "end": 142,
        "start_line": 10,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 142,
    "start_line": 1,
    "start_col": 0
  }
}

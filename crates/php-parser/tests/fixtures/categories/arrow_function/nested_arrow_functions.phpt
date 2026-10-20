===source===
<?php
$f = fn($x) => fn($y) => fn($z) => $x + $y + $z;
$g = fn($a) => $a > 0 ? fn($b) => $b * 2 : fn($b) => $b * -1;
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
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 14,
                            "end": 16
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 14,
                          "end": 16
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "ArrowFunction": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": {
                                "name": "y",
                                "span": {
                                  "start": 24,
                                  "end": 26
                                }
                              },
                              "type_hint": null,
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "attributes": [],
                              "span": {
                                "start": 24,
                                "end": 26
                              }
                            }
                          ],
                          "return_type": null,
                          "body": {
                            "kind": {
                              "ArrowFunction": {
                                "is_static": false,
                                "by_ref": false,
                                "params": [
                                  {
                                    "name": {
                                      "name": "z",
                                      "span": {
                                        "start": 34,
                                        "end": 36
                                      }
                                    },
                                    "type_hint": null,
                                    "default": null,
                                    "by_ref": false,
                                    "variadic": false,
                                    "attributes": [],
                                    "span": {
                                      "start": 34,
                                      "end": 36
                                    }
                                  }
                                ],
                                "return_type": null,
                                "body": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Binary": {
                                            "left": {
                                              "kind": {
                                                "Variable": "x"
                                              },
                                              "span": {
                                                "start": 41,
                                                "end": 43
                                              }
                                            },
                                            "op": "Add",
                                            "right": {
                                              "kind": {
                                                "Variable": "y"
                                              },
                                              "span": {
                                                "start": 46,
                                                "end": 48
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 41,
                                          "end": 48
                                        }
                                      },
                                      "op": "Add",
                                      "right": {
                                        "kind": {
                                          "Variable": "z"
                                        },
                                        "span": {
                                          "start": 51,
                                          "end": 53
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 41,
                                    "end": 53
                                  }
                                },
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 31,
                              "end": 53
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 53
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 53
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 53
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 55,
                  "end": 57
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 63,
                            "end": 65
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 63,
                          "end": 65
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Ternary": {
                          "condition": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 70,
                                    "end": 72
                                  }
                                },
                                "op": "Greater",
                                "right": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 75,
                                    "end": 76
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 70,
                              "end": 76
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "ArrowFunction": {
                                "is_static": false,
                                "by_ref": false,
                                "params": [
                                  {
                                    "name": {
                                      "name": "b",
                                      "span": {
                                        "start": 82,
                                        "end": 84
                                      }
                                    },
                                    "type_hint": null,
                                    "default": null,
                                    "by_ref": false,
                                    "variadic": false,
                                    "attributes": [],
                                    "span": {
                                      "start": 82,
                                      "end": 84
                                    }
                                  }
                                ],
                                "return_type": null,
                                "body": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Variable": "b"
                                        },
                                        "span": {
                                          "start": 89,
                                          "end": 91
                                        }
                                      },
                                      "op": "Mul",
                                      "right": {
                                        "kind": {
                                          "Int": 2
                                        },
                                        "span": {
                                          "start": 94,
                                          "end": 95
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 89,
                                    "end": 95
                                  }
                                },
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 79,
                              "end": 95
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "ArrowFunction": {
                                "is_static": false,
                                "by_ref": false,
                                "params": [
                                  {
                                    "name": {
                                      "name": "b",
                                      "span": {
                                        "start": 101,
                                        "end": 103
                                      }
                                    },
                                    "type_hint": null,
                                    "default": null,
                                    "by_ref": false,
                                    "variadic": false,
                                    "attributes": [],
                                    "span": {
                                      "start": 101,
                                      "end": 103
                                    }
                                  }
                                ],
                                "return_type": null,
                                "body": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Variable": "b"
                                        },
                                        "span": {
                                          "start": 108,
                                          "end": 110
                                        }
                                      },
                                      "op": "Mul",
                                      "right": {
                                        "kind": {
                                          "UnaryPrefix": {
                                            "op": "Negate",
                                            "operand": {
                                              "kind": {
                                                "Int": 1
                                              },
                                              "span": {
                                                "start": 114,
                                                "end": 115
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 113,
                                          "end": 115
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 108,
                                    "end": 115
                                  }
                                },
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 98,
                              "end": 115
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 115
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 60,
                  "end": 115
                }
              }
            }
          },
          "span": {
            "start": 55,
            "end": 115
          }
        }
      },
      "span": {
        "start": 55,
        "end": 116
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 116
  }
}

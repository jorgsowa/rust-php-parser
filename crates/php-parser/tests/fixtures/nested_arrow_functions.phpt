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
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
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
                        "name": "x",
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
                          "start": 14,
                          "end": 16,
                          "start_line": 2,
                          "start_col": 8
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
                              "name": "y",
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
                                "start": 24,
                                "end": 26,
                                "start_line": 2,
                                "start_col": 18
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
                                    "name": "z",
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
                                      "start": 34,
                                      "end": 36,
                                      "start_line": 2,
                                      "start_col": 28
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
                                                "end": 43,
                                                "start_line": 2,
                                                "start_col": 35
                                              }
                                            },
                                            "op": "Add",
                                            "right": {
                                              "kind": {
                                                "Variable": "y"
                                              },
                                              "span": {
                                                "start": 46,
                                                "end": 48,
                                                "start_line": 2,
                                                "start_col": 40
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 41,
                                          "end": 48,
                                          "start_line": 2,
                                          "start_col": 35
                                        }
                                      },
                                      "op": "Add",
                                      "right": {
                                        "kind": {
                                          "Variable": "z"
                                        },
                                        "span": {
                                          "start": 51,
                                          "end": 53,
                                          "start_line": 2,
                                          "start_col": 45
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 41,
                                    "end": 53,
                                    "start_line": 2,
                                    "start_col": 35
                                  }
                                },
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 31,
                              "end": 53,
                              "start_line": 2,
                              "start_col": 25
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 53,
                        "start_line": 2,
                        "start_col": 15
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 53,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 53,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 55,
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
                  "Variable": "g"
                },
                "span": {
                  "start": 55,
                  "end": 57,
                  "start_line": 3,
                  "start_col": 0
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
                        "name": "a",
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
                          "start": 63,
                          "end": 65,
                          "start_line": 3,
                          "start_col": 8
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
                                    "end": 72,
                                    "start_line": 3,
                                    "start_col": 15
                                  }
                                },
                                "op": "Greater",
                                "right": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 75,
                                    "end": 76,
                                    "start_line": 3,
                                    "start_col": 20
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 70,
                              "end": 76,
                              "start_line": 3,
                              "start_col": 15
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "ArrowFunction": {
                                "is_static": false,
                                "by_ref": false,
                                "params": [
                                  {
                                    "name": "b",
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
                                      "start": 82,
                                      "end": 84,
                                      "start_line": 3,
                                      "start_col": 27
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
                                          "end": 91,
                                          "start_line": 3,
                                          "start_col": 34
                                        }
                                      },
                                      "op": "Mul",
                                      "right": {
                                        "kind": {
                                          "Int": 2
                                        },
                                        "span": {
                                          "start": 94,
                                          "end": 95,
                                          "start_line": 3,
                                          "start_col": 39
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 89,
                                    "end": 95,
                                    "start_line": 3,
                                    "start_col": 34
                                  }
                                },
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 79,
                              "end": 95,
                              "start_line": 3,
                              "start_col": 24
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "ArrowFunction": {
                                "is_static": false,
                                "by_ref": false,
                                "params": [
                                  {
                                    "name": "b",
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
                                      "start": 101,
                                      "end": 103,
                                      "start_line": 3,
                                      "start_col": 46
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
                                          "end": 110,
                                          "start_line": 3,
                                          "start_col": 53
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
                                                "end": 115,
                                                "start_line": 3,
                                                "start_col": 59
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 113,
                                          "end": 115,
                                          "start_line": 3,
                                          "start_col": 58
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 108,
                                    "end": 115,
                                    "start_line": 3,
                                    "start_col": 53
                                  }
                                },
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 98,
                              "end": 115,
                              "start_line": 3,
                              "start_col": 43
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 115,
                        "start_line": 3,
                        "start_col": 15
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 60,
                  "end": 115,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 55,
            "end": 115,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 55,
        "end": 116,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 116,
    "start_line": 1,
    "start_col": 0
  }
}

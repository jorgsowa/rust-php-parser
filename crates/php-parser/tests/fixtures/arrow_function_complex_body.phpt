===source===
<?php $f = fn($x, $y) => $x > $y ? $x - $y : $y - $x;
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
                  "start_line": 1,
                  "start_col": 6
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
                          "start_line": 1,
                          "start_col": 14
                        }
                      },
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
                          "start": 18,
                          "end": 20,
                          "start_line": 1,
                          "start_col": 18
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
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 25,
                                    "end": 27,
                                    "start_line": 1,
                                    "start_col": 25
                                  }
                                },
                                "op": "Greater",
                                "right": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 30,
                                    "end": 32,
                                    "start_line": 1,
                                    "start_col": 30
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 25,
                              "end": 32,
                              "start_line": 1,
                              "start_col": 25
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 35,
                                    "end": 37,
                                    "start_line": 1,
                                    "start_col": 35
                                  }
                                },
                                "op": "Sub",
                                "right": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 40,
                                    "end": 42,
                                    "start_line": 1,
                                    "start_col": 40
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 35,
                              "end": 42,
                              "start_line": 1,
                              "start_col": 35
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 45,
                                    "end": 47,
                                    "start_line": 1,
                                    "start_col": 45
                                  }
                                },
                                "op": "Sub",
                                "right": {
                                  "kind": {
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 50,
                                    "end": 52,
                                    "start_line": 1,
                                    "start_col": 50
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 45,
                              "end": 52,
                              "start_line": 1,
                              "start_col": 45
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 52,
                        "start_line": 1,
                        "start_col": 25
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 52,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 52,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 53,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}

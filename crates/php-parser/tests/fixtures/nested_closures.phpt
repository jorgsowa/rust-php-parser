===source===
<?php
$outer = function($x) {
    $inner = function($y) use ($x) {
        return $x + $y;
    };
    return $inner;
};
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
                  "Variable": "outer"
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
                  "Closure": {
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
                          "start": 24,
                          "end": 26,
                          "start_line": 2,
                          "start_col": 18
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Expression": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "inner"
                                  },
                                  "span": {
                                    "start": 34,
                                    "end": 40,
                                    "start_line": 3,
                                    "start_col": 4
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Closure": {
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
                                            "start": 52,
                                            "end": 54,
                                            "start_line": 3,
                                            "start_col": 22
                                          }
                                        }
                                      ],
                                      "use_vars": [
                                        {
                                          "name": "x",
                                          "by_ref": false,
                                          "span": {
                                            "start": 61,
                                            "end": 63,
                                            "start_line": 3,
                                            "start_col": 31
                                          }
                                        }
                                      ],
                                      "return_type": null,
                                      "body": [
                                        {
                                          "kind": {
                                            "Return": {
                                              "kind": {
                                                "Binary": {
                                                  "left": {
                                                    "kind": {
                                                      "Variable": "x"
                                                    },
                                                    "span": {
                                                      "start": 82,
                                                      "end": 84,
                                                      "start_line": 4,
                                                      "start_col": 15
                                                    }
                                                  },
                                                  "op": "Add",
                                                  "right": {
                                                    "kind": {
                                                      "Variable": "y"
                                                    },
                                                    "span": {
                                                      "start": 87,
                                                      "end": 89,
                                                      "start_line": 4,
                                                      "start_col": 20
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 82,
                                                "end": 89,
                                                "start_line": 4,
                                                "start_col": 15
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 75,
                                            "end": 95,
                                            "start_line": 4,
                                            "start_col": 8
                                          }
                                        }
                                      ],
                                      "attributes": []
                                    }
                                  },
                                  "span": {
                                    "start": 43,
                                    "end": 96,
                                    "start_line": 3,
                                    "start_col": 13
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 34,
                              "end": 96,
                              "start_line": 3,
                              "start_col": 4
                            }
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 102,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Variable": "inner"
                            },
                            "span": {
                              "start": 109,
                              "end": 115,
                              "start_line": 6,
                              "start_col": 11
                            }
                          }
                        },
                        "span": {
                          "start": 102,
                          "end": 117,
                          "start_line": 6,
                          "start_col": 4
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 15,
                  "end": 118,
                  "start_line": 2,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 118,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 119,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 119,
    "start_line": 1,
    "start_col": 0
  }
}

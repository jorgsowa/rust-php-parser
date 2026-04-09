===source===
<?php $a = ['map' => fn($x) => $x * 2, 'filter' => fn($x) => $x > 0];
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
                  "Variable": "a"
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "map"
                        },
                        "span": {
                          "start": 12,
                          "end": 17,
                          "start_line": 1,
                          "start_col": 12
                        }
                      },
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
                                  "start": 24,
                                  "end": 26,
                                  "start_line": 1,
                                  "start_col": 24
                                }
                              }
                            ],
                            "return_type": null,
                            "body": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Variable": "x"
                                    },
                                    "span": {
                                      "start": 31,
                                      "end": 33,
                                      "start_line": 1,
                                      "start_col": 31
                                    }
                                  },
                                  "op": "Mul",
                                  "right": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 36,
                                      "end": 37,
                                      "start_line": 1,
                                      "start_col": 36
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 31,
                                "end": 37,
                                "start_line": 1,
                                "start_col": 31
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 37,
                          "start_line": 1,
                          "start_col": 21
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 37,
                        "start_line": 1,
                        "start_col": 12
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "filter"
                        },
                        "span": {
                          "start": 39,
                          "end": 47,
                          "start_line": 1,
                          "start_col": 39
                        }
                      },
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
                                  "start": 54,
                                  "end": 56,
                                  "start_line": 1,
                                  "start_col": 54
                                }
                              }
                            ],
                            "return_type": null,
                            "body": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Variable": "x"
                                    },
                                    "span": {
                                      "start": 61,
                                      "end": 63,
                                      "start_line": 1,
                                      "start_col": 61
                                    }
                                  },
                                  "op": "Greater",
                                  "right": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 66,
                                      "end": 67,
                                      "start_line": 1,
                                      "start_col": 66
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 61,
                                "end": 67,
                                "start_line": 1,
                                "start_col": 61
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 51,
                          "end": 67,
                          "start_line": 1,
                          "start_col": 51
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 39,
                        "end": 67,
                        "start_line": 1,
                        "start_col": 39
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 68,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 68,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 69,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php
function gen() {
    yield from array_map(fn($x) => $x * 2, [1, 2, 3]);
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Identifier": "array_map"
                              },
                              "span": {
                                "start": 38,
                                "end": 47,
                                "start_line": 3,
                                "start_col": 15
                              }
                            },
                            "args": [
                              {
                                "name": null,
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
                                            "start": 51,
                                            "end": 53,
                                            "start_line": 3,
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
                                                "Variable": "x"
                                              },
                                              "span": {
                                                "start": 58,
                                                "end": 60,
                                                "start_line": 3,
                                                "start_col": 35
                                              }
                                            },
                                            "op": "Mul",
                                            "right": {
                                              "kind": {
                                                "Int": 2
                                              },
                                              "span": {
                                                "start": 63,
                                                "end": 64,
                                                "start_line": 3,
                                                "start_col": 40
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 58,
                                          "end": 64,
                                          "start_line": 3,
                                          "start_col": 35
                                        }
                                      },
                                      "attributes": []
                                    }
                                  },
                                  "span": {
                                    "start": 48,
                                    "end": 64,
                                    "start_line": 3,
                                    "start_col": 25
                                  }
                                },
                                "unpack": false,
                                "by_ref": false,
                                "span": {
                                  "start": 48,
                                  "end": 64,
                                  "start_line": 3,
                                  "start_col": 25
                                }
                              },
                              {
                                "name": null,
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
                                            "start": 67,
                                            "end": 68,
                                            "start_line": 3,
                                            "start_col": 44
                                          }
                                        },
                                        "unpack": false,
                                        "span": {
                                          "start": 67,
                                          "end": 68,
                                          "start_line": 3,
                                          "start_col": 44
                                        }
                                      },
                                      {
                                        "key": null,
                                        "value": {
                                          "kind": {
                                            "Int": 2
                                          },
                                          "span": {
                                            "start": 70,
                                            "end": 71,
                                            "start_line": 3,
                                            "start_col": 47
                                          }
                                        },
                                        "unpack": false,
                                        "span": {
                                          "start": 70,
                                          "end": 71,
                                          "start_line": 3,
                                          "start_col": 47
                                        }
                                      },
                                      {
                                        "key": null,
                                        "value": {
                                          "kind": {
                                            "Int": 3
                                          },
                                          "span": {
                                            "start": 73,
                                            "end": 74,
                                            "start_line": 3,
                                            "start_col": 50
                                          }
                                        },
                                        "unpack": false,
                                        "span": {
                                          "start": 73,
                                          "end": 74,
                                          "start_line": 3,
                                          "start_col": 50
                                        }
                                      }
                                    ]
                                  },
                                  "span": {
                                    "start": 66,
                                    "end": 75,
                                    "start_line": 3,
                                    "start_col": 43
                                  }
                                },
                                "unpack": false,
                                "by_ref": false,
                                "span": {
                                  "start": 66,
                                  "end": 75,
                                  "start_line": 3,
                                  "start_col": 43
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 38,
                          "end": 76,
                          "start_line": 3,
                          "start_col": 15
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 76,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 78,
                "start_line": 3,
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
        "end": 79,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79,
    "start_line": 1,
    "start_col": 0
  }
}

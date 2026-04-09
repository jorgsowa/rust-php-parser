===source===
<?php
function gen($x) {
    $v = match(true) {
        $x > 0 => yield $x,
        default => yield 0,
    };
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
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
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "v"
                        },
                        "span": {
                          "start": 29,
                          "end": 31,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Match": {
                            "subject": {
                              "kind": {
                                "Bool": true
                              },
                              "span": {
                                "start": 40,
                                "end": 44,
                                "start_line": 3,
                                "start_col": 15
                              }
                            },
                            "arms": [
                              {
                                "conditions": [
                                  {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "Variable": "x"
                                          },
                                          "span": {
                                            "start": 56,
                                            "end": 58,
                                            "start_line": 4,
                                            "start_col": 8
                                          }
                                        },
                                        "op": "Greater",
                                        "right": {
                                          "kind": {
                                            "Int": 0
                                          },
                                          "span": {
                                            "start": 61,
                                            "end": 62,
                                            "start_line": 4,
                                            "start_col": 13
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 56,
                                      "end": 62,
                                      "start_line": 4,
                                      "start_col": 8
                                    }
                                  }
                                ],
                                "body": {
                                  "kind": {
                                    "Yield": {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "x"
                                        },
                                        "span": {
                                          "start": 72,
                                          "end": 74,
                                          "start_line": 4,
                                          "start_col": 24
                                        }
                                      },
                                      "is_from": false
                                    }
                                  },
                                  "span": {
                                    "start": 66,
                                    "end": 74,
                                    "start_line": 4,
                                    "start_col": 18
                                  }
                                },
                                "span": {
                                  "start": 56,
                                  "end": 74,
                                  "start_line": 4,
                                  "start_col": 8
                                }
                              },
                              {
                                "conditions": null,
                                "body": {
                                  "kind": {
                                    "Yield": {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 0
                                        },
                                        "span": {
                                          "start": 101,
                                          "end": 102,
                                          "start_line": 5,
                                          "start_col": 25
                                        }
                                      },
                                      "is_from": false
                                    }
                                  },
                                  "span": {
                                    "start": 95,
                                    "end": 102,
                                    "start_line": 5,
                                    "start_col": 19
                                  }
                                },
                                "span": {
                                  "start": 84,
                                  "end": 102,
                                  "start_line": 5,
                                  "start_col": 8
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 109,
                          "start_line": 3,
                          "start_col": 9
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 109,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 29,
                "end": 111,
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
        "end": 112,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112,
    "start_line": 1,
    "start_col": 0
  }
}

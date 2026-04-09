===source===
<?php
function foo(
    (Countable&Traversable)|(ArrayAccess&Stringable)|null $x
): (A&B)|(C&D) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Countable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 25,
                                  "end": 34,
                                  "start_line": 3,
                                  "start_col": 5
                                }
                              }
                            },
                            "span": {
                              "start": 25,
                              "end": 34,
                              "start_line": 3,
                              "start_col": 5
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Traversable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 35,
                                  "end": 46,
                                  "start_line": 3,
                                  "start_col": 15
                                }
                              }
                            },
                            "span": {
                              "start": 35,
                              "end": 46,
                              "start_line": 3,
                              "start_col": 15
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 24,
                        "end": 47,
                        "start_line": 3,
                        "start_col": 4
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "ArrayAccess"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 49,
                                  "end": 60,
                                  "start_line": 3,
                                  "start_col": 29
                                }
                              }
                            },
                            "span": {
                              "start": 49,
                              "end": 60,
                              "start_line": 3,
                              "start_col": 29
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Stringable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 61,
                                  "end": 71,
                                  "start_line": 3,
                                  "start_col": 41
                                }
                              }
                            },
                            "span": {
                              "start": 61,
                              "end": 71,
                              "start_line": 3,
                              "start_col": 41
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 48,
                        "end": 72,
                        "start_line": 3,
                        "start_col": 28
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "null"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 73,
                            "end": 77,
                            "start_line": 3,
                            "start_col": 53
                          }
                        }
                      },
                      "span": {
                        "start": 73,
                        "end": 77,
                        "start_line": 3,
                        "start_col": 53
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 77,
                  "start_line": 3,
                  "start_col": 4
                }
              },
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
                "end": 80,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 85,
                              "end": 86,
                              "start_line": 4,
                              "start_col": 4
                            }
                          }
                        },
                        "span": {
                          "start": 85,
                          "end": 86,
                          "start_line": 4,
                          "start_col": 4
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 87,
                              "end": 88,
                              "start_line": 4,
                              "start_col": 6
                            }
                          }
                        },
                        "span": {
                          "start": 87,
                          "end": 88,
                          "start_line": 4,
                          "start_col": 6
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 84,
                    "end": 89,
                    "start_line": 4,
                    "start_col": 3
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "C"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 91,
                              "end": 92,
                              "start_line": 4,
                              "start_col": 10
                            }
                          }
                        },
                        "span": {
                          "start": 91,
                          "end": 92,
                          "start_line": 4,
                          "start_col": 10
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "D"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 93,
                              "end": 94,
                              "start_line": 4,
                              "start_col": 12
                            }
                          }
                        },
                        "span": {
                          "start": 93,
                          "end": 94,
                          "start_line": 4,
                          "start_col": 12
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 90,
                    "end": 95,
                    "start_line": 4,
                    "start_col": 9
                  }
                }
              ]
            },
            "span": {
              "start": 84,
              "end": 95,
              "start_line": 4,
              "start_col": 3
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 98,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 98,
    "start_line": 1,
    "start_col": 0
  }
}

===source===
<?php function foo((Countable&Traversable)|null $x): (A&B)|null {}
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
                                  "start": 20,
                                  "end": 29,
                                  "start_line": 1,
                                  "start_col": 20
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 29,
                              "start_line": 1,
                              "start_col": 20
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
                                  "start": 30,
                                  "end": 41,
                                  "start_line": 1,
                                  "start_col": 30
                                }
                              }
                            },
                            "span": {
                              "start": 30,
                              "end": 41,
                              "start_line": 1,
                              "start_col": 30
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 19,
                        "end": 42,
                        "start_line": 1,
                        "start_col": 19
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
                            "start": 43,
                            "end": 47,
                            "start_line": 1,
                            "start_col": 43
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 47,
                        "start_line": 1,
                        "start_col": 43
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 47,
                  "start_line": 1,
                  "start_col": 19
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
                "start": 19,
                "end": 50,
                "start_line": 1,
                "start_col": 19
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
                              "start": 54,
                              "end": 55,
                              "start_line": 1,
                              "start_col": 54
                            }
                          }
                        },
                        "span": {
                          "start": 54,
                          "end": 55,
                          "start_line": 1,
                          "start_col": 54
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
                              "start": 56,
                              "end": 57,
                              "start_line": 1,
                              "start_col": 56
                            }
                          }
                        },
                        "span": {
                          "start": 56,
                          "end": 57,
                          "start_line": 1,
                          "start_col": 56
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 53,
                    "end": 58,
                    "start_line": 1,
                    "start_col": 53
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
                        "start": 59,
                        "end": 63,
                        "start_line": 1,
                        "start_col": 59
                      }
                    }
                  },
                  "span": {
                    "start": 59,
                    "end": 63,
                    "start_line": 1,
                    "start_col": 59
                  }
                }
              ]
            },
            "span": {
              "start": 53,
              "end": 63,
              "start_line": 1,
              "start_col": 53
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 66,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66,
    "start_line": 1,
    "start_col": 0
  }
}

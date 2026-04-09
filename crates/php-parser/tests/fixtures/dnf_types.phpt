===source===
<?php
function foo((A&B)|C $x): (X&Y)|Z {
    return $x;
}
function bar((A&B)|(C&D) $y): (E&F)|null {
    return $y;
}
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
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 20,
                                  "end": 21,
                                  "start_line": 2,
                                  "start_col": 14
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 21,
                              "start_line": 2,
                              "start_col": 14
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
                                  "start": 22,
                                  "end": 23,
                                  "start_line": 2,
                                  "start_col": 16
                                }
                              }
                            },
                            "span": {
                              "start": 22,
                              "end": 23,
                              "start_line": 2,
                              "start_col": 16
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 19,
                        "end": 24,
                        "start_line": 2,
                        "start_col": 13
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 25,
                            "end": 27,
                            "start_line": 2,
                            "start_col": 19
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 27,
                        "start_line": 2,
                        "start_col": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 27,
                  "start_line": 2,
                  "start_col": 13
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
                "end": 29,
                "start_line": 2,
                "start_col": 13
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 53,
                    "end": 55,
                    "start_line": 3,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 46,
                "end": 57,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
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
                              "X"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 33,
                              "end": 34,
                              "start_line": 2,
                              "start_col": 27
                            }
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 34,
                          "start_line": 2,
                          "start_col": 27
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Y"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 35,
                              "end": 36,
                              "start_line": 2,
                              "start_col": 29
                            }
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 36,
                          "start_line": 2,
                          "start_col": 29
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 32,
                    "end": 37,
                    "start_line": 2,
                    "start_col": 26
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Z"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 38,
                        "end": 40,
                        "start_line": 2,
                        "start_col": 32
                      }
                    }
                  },
                  "span": {
                    "start": 38,
                    "end": 40,
                    "start_line": 2,
                    "start_col": 32
                  }
                }
              ]
            },
            "span": {
              "start": 32,
              "end": 40,
              "start_line": 2,
              "start_col": 26
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "bar",
          "params": [
            {
              "name": "y",
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
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 73,
                                  "end": 74,
                                  "start_line": 5,
                                  "start_col": 14
                                }
                              }
                            },
                            "span": {
                              "start": 73,
                              "end": 74,
                              "start_line": 5,
                              "start_col": 14
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
                                  "start": 75,
                                  "end": 76,
                                  "start_line": 5,
                                  "start_col": 16
                                }
                              }
                            },
                            "span": {
                              "start": 75,
                              "end": 76,
                              "start_line": 5,
                              "start_col": 16
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 72,
                        "end": 77,
                        "start_line": 5,
                        "start_col": 13
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
                                  "start": 79,
                                  "end": 80,
                                  "start_line": 5,
                                  "start_col": 20
                                }
                              }
                            },
                            "span": {
                              "start": 79,
                              "end": 80,
                              "start_line": 5,
                              "start_col": 20
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
                                  "start": 81,
                                  "end": 82,
                                  "start_line": 5,
                                  "start_col": 22
                                }
                              }
                            },
                            "span": {
                              "start": 81,
                              "end": 82,
                              "start_line": 5,
                              "start_col": 22
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 78,
                        "end": 83,
                        "start_line": 5,
                        "start_col": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 72,
                  "end": 83,
                  "start_line": 5,
                  "start_col": 13
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
                "start": 72,
                "end": 86,
                "start_line": 5,
                "start_col": 13
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "y"
                  },
                  "span": {
                    "start": 113,
                    "end": 115,
                    "start_line": 6,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 106,
                "end": 117,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
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
                              "E"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 90,
                              "end": 91,
                              "start_line": 5,
                              "start_col": 31
                            }
                          }
                        },
                        "span": {
                          "start": 90,
                          "end": 91,
                          "start_line": 5,
                          "start_col": 31
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "F"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 92,
                              "end": 93,
                              "start_line": 5,
                              "start_col": 33
                            }
                          }
                        },
                        "span": {
                          "start": 92,
                          "end": 93,
                          "start_line": 5,
                          "start_col": 33
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 89,
                    "end": 94,
                    "start_line": 5,
                    "start_col": 30
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
                        "start": 95,
                        "end": 99,
                        "start_line": 5,
                        "start_col": 36
                      }
                    }
                  },
                  "span": {
                    "start": 95,
                    "end": 99,
                    "start_line": 5,
                    "start_col": 36
                  }
                }
              ]
            },
            "span": {
              "start": 89,
              "end": 99,
              "start_line": 5,
              "start_col": 30
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 59,
        "end": 118,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 118,
    "start_line": 1,
    "start_col": 0
  }
}

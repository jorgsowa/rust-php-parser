===source===
<?php
function process(?int $x, int|string $y, Countable&Traversable $z): ?string {
    return null;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "process",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 24,
                          "end": 27,
                          "start_line": 2,
                          "start_col": 18
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 27,
                      "start_line": 2,
                      "start_col": 18
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 27,
                  "start_line": 2,
                  "start_col": 17
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
                "start": 23,
                "end": 30,
                "start_line": 2,
                "start_col": 17
              }
            },
            {
              "name": "y",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 32,
                            "end": 35,
                            "start_line": 2,
                            "start_col": 26
                          }
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 35,
                        "start_line": 2,
                        "start_col": 26
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 36,
                            "end": 42,
                            "start_line": 2,
                            "start_col": 30
                          }
                        }
                      },
                      "span": {
                        "start": 36,
                        "end": 42,
                        "start_line": 2,
                        "start_col": 30
                      }
                    }
                  ]
                },
                "span": {
                  "start": 32,
                  "end": 42,
                  "start_line": 2,
                  "start_col": 26
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
                "start": 32,
                "end": 45,
                "start_line": 2,
                "start_col": 26
              }
            },
            {
              "name": "z",
              "type_hint": {
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
                            "start": 47,
                            "end": 56,
                            "start_line": 2,
                            "start_col": 41
                          }
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 56,
                        "start_line": 2,
                        "start_col": 41
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
                            "start": 57,
                            "end": 69,
                            "start_line": 2,
                            "start_col": 51
                          }
                        }
                      },
                      "span": {
                        "start": 57,
                        "end": 69,
                        "start_line": 2,
                        "start_col": 51
                      }
                    }
                  ]
                },
                "span": {
                  "start": 47,
                  "end": 69,
                  "start_line": 2,
                  "start_col": 41
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
                "start": 47,
                "end": 71,
                "start_line": 2,
                "start_col": 41
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 95,
                    "end": 99,
                    "start_line": 3,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 88,
                "end": 101,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 75,
                      "end": 81,
                      "start_line": 2,
                      "start_col": 69
                    }
                  }
                },
                "span": {
                  "start": 75,
                  "end": 81,
                  "start_line": 2,
                  "start_col": 69
                }
              }
            },
            "span": {
              "start": 74,
              "end": 81,
              "start_line": 2,
              "start_col": 68
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 102,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102,
    "start_line": 1,
    "start_col": 0
  }
}

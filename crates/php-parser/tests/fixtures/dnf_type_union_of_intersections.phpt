===source===
<?php function foo((Countable&Traversable)|(ArrayAccess&Stringable) $x): void {}
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
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "ArrayAccess"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 44,
                                  "end": 55,
                                  "start_line": 1,
                                  "start_col": 44
                                }
                              }
                            },
                            "span": {
                              "start": 44,
                              "end": 55,
                              "start_line": 1,
                              "start_col": 44
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
                                  "start": 56,
                                  "end": 66,
                                  "start_line": 1,
                                  "start_col": 56
                                }
                              }
                            },
                            "span": {
                              "start": 56,
                              "end": 66,
                              "start_line": 1,
                              "start_col": 56
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 43,
                        "end": 67,
                        "start_line": 1,
                        "start_col": 43
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 67,
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
                "end": 70,
                "start_line": 1,
                "start_col": 19
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 73,
                  "end": 77,
                  "start_line": 1,
                  "start_col": 73
                }
              }
            },
            "span": {
              "start": 73,
              "end": 77,
              "start_line": 1,
              "start_col": 73
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 80,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80,
    "start_line": 1,
    "start_col": 0
  }
}

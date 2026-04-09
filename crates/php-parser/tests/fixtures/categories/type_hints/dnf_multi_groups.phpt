===source===
<?php function f((A&B)|(C&D) $x) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
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
                                  "start": 18,
                                  "end": 19,
                                  "start_line": 1,
                                  "start_col": 18
                                }
                              }
                            },
                            "span": {
                              "start": 18,
                              "end": 19,
                              "start_line": 1,
                              "start_col": 18
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
                                  "start": 20,
                                  "end": 21,
                                  "start_line": 1,
                                  "start_col": 20
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 21,
                              "start_line": 1,
                              "start_col": 20
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 17,
                        "end": 22,
                        "start_line": 1,
                        "start_col": 17
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
                                  "start": 24,
                                  "end": 25,
                                  "start_line": 1,
                                  "start_col": 24
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 25,
                              "start_line": 1,
                              "start_col": 24
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
                                  "start": 26,
                                  "end": 27,
                                  "start_line": 1,
                                  "start_col": 26
                                }
                              }
                            },
                            "span": {
                              "start": 26,
                              "end": 27,
                              "start_line": 1,
                              "start_col": 26
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 23,
                        "end": 28,
                        "start_line": 1,
                        "start_col": 23
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 28,
                  "start_line": 1,
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
                "start": 17,
                "end": 31,
                "start_line": 1,
                "start_col": 17
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}

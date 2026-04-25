===config===
min_php=8.2
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
                                  "end": 19
                                }
                              }
                            },
                            "span": {
                              "start": 18,
                              "end": 19
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
                                  "end": 21
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 21
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 17,
                        "end": 22
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
                                  "end": 25
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 25
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
                                  "end": 27
                                }
                              }
                            },
                            "span": {
                              "start": 26,
                              "end": 27
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 23,
                        "end": 28
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 28
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
                "end": 31
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
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
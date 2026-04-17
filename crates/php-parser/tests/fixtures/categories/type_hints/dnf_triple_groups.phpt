===config===
min_php=8.2
===source===
<?php function foo((A&B)|(C&D)|(E&F) $x): void {}
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
                                  "end": 21
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 21
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
                                  "end": 23
                                }
                              }
                            },
                            "span": {
                              "start": 22,
                              "end": 23
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 19,
                        "end": 24
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
                                  "start": 26,
                                  "end": 27
                                }
                              }
                            },
                            "span": {
                              "start": 26,
                              "end": 27
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
                                  "start": 28,
                                  "end": 29
                                }
                              }
                            },
                            "span": {
                              "start": 28,
                              "end": 29
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 25,
                        "end": 30
                      }
                    },
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
                                  "start": 32,
                                  "end": 33
                                }
                              }
                            },
                            "span": {
                              "start": 32,
                              "end": 33
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
                                  "start": 34,
                                  "end": 35
                                }
                              }
                            },
                            "span": {
                              "start": 34,
                              "end": 35
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 31,
                        "end": 36
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 36
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
                "end": 39
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
                  "start": 42,
                  "end": 46
                }
              }
            },
            "span": {
              "start": 42,
              "end": 46
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}

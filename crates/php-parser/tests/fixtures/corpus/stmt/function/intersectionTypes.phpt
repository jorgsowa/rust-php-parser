===source===
<?php

class Test {
    public A&B $prop;
}

function test(A&B $a): A&B {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
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
                                "start": 31,
                                "end": 32,
                                "start_line": 4,
                                "start_col": 11
                              }
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 32,
                            "start_line": 4,
                            "start_col": 11
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
                                "start": 33,
                                "end": 35,
                                "start_line": 4,
                                "start_col": 13
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 35,
                            "start_line": 4,
                            "start_col": 13
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 31,
                      "end": 35,
                      "start_line": 4,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 40,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 43,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [
            {
              "name": "a",
              "type_hint": {
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
                            "start": 59,
                            "end": 60,
                            "start_line": 7,
                            "start_col": 14
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 60,
                        "start_line": 7,
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
                            "start": 61,
                            "end": 63,
                            "start_line": 7,
                            "start_col": 16
                          }
                        }
                      },
                      "span": {
                        "start": 61,
                        "end": 63,
                        "start_line": 7,
                        "start_col": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 59,
                  "end": 63,
                  "start_line": 7,
                  "start_col": 14
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
                "start": 59,
                "end": 65,
                "start_line": 7,
                "start_col": 14
              }
            }
          ],
          "body": [],
          "return_type": {
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
                        "start": 68,
                        "end": 69,
                        "start_line": 7,
                        "start_col": 23
                      }
                    }
                  },
                  "span": {
                    "start": 68,
                    "end": 69,
                    "start_line": 7,
                    "start_col": 23
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
                        "start": 70,
                        "end": 72,
                        "start_line": 7,
                        "start_col": 25
                      }
                    }
                  },
                  "span": {
                    "start": 70,
                    "end": 72,
                    "start_line": 7,
                    "start_col": 25
                  }
                }
              ]
            },
            "span": {
              "start": 68,
              "end": 72,
              "start_line": 7,
              "start_col": 23
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 45,
        "end": 74,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74,
    "start_line": 1,
    "start_col": 0
  }
}

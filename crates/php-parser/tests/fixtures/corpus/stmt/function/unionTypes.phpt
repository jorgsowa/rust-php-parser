===source===
<?php

class Test {
    public A|iterable|null $prop;
}

function test(A|B $a): int|false {}
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
                      "Union": [
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
                                "iterable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 33,
                                "end": 41,
                                "start_line": 4,
                                "start_col": 13
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 41,
                            "start_line": 4,
                            "start_col": 13
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
                                "start": 42,
                                "end": 46,
                                "start_line": 4,
                                "start_col": 22
                              }
                            }
                          },
                          "span": {
                            "start": 42,
                            "end": 46,
                            "start_line": 4,
                            "start_col": 22
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 31,
                      "end": 46,
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
                "end": 52,
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
        "end": 55,
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
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 71,
                            "end": 72,
                            "start_line": 7,
                            "start_col": 14
                          }
                        }
                      },
                      "span": {
                        "start": 71,
                        "end": 72,
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
                            "start": 73,
                            "end": 75,
                            "start_line": 7,
                            "start_col": 16
                          }
                        }
                      },
                      "span": {
                        "start": 73,
                        "end": 75,
                        "start_line": 7,
                        "start_col": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 71,
                  "end": 75,
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
                "start": 71,
                "end": 77,
                "start_line": 7,
                "start_col": 14
              }
            }
          ],
          "body": [],
          "return_type": {
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
                        "start": 80,
                        "end": 83,
                        "start_line": 7,
                        "start_col": 23
                      }
                    }
                  },
                  "span": {
                    "start": 80,
                    "end": 83,
                    "start_line": 7,
                    "start_col": 23
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 84,
                        "end": 89,
                        "start_line": 7,
                        "start_col": 27
                      }
                    }
                  },
                  "span": {
                    "start": 84,
                    "end": 89,
                    "start_line": 7,
                    "start_col": 27
                  }
                }
              ]
            },
            "span": {
              "start": 80,
              "end": 89,
              "start_line": 7,
              "start_col": 23
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 57,
        "end": 92,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92,
    "start_line": 1,
    "start_col": 0
  }
}

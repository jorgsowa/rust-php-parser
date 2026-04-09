===source===
<?php
class Test {
    const int X = 1;
    private const string Y = "a", Z = "b";
    const array ARRAY = [];
    const Foo|Bar|null FOO = null;
}
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
                "ClassConst": {
                  "name": "X",
                  "visibility": null,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 29,
                          "end": 32,
                          "start_line": 3,
                          "start_col": 10
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 32,
                      "start_line": 3,
                      "start_col": 10
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 37,
                      "end": 38,
                      "start_line": 3,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 44,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "Y",
                  "visibility": "Private",
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 58,
                          "end": 64,
                          "start_line": 4,
                          "start_col": 18
                        }
                      }
                    },
                    "span": {
                      "start": 58,
                      "end": 64,
                      "start_line": 4,
                      "start_col": 18
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 69,
                      "end": 72,
                      "start_line": 4,
                      "start_col": 29
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 87,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "Z",
                  "visibility": "Private",
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 58,
                          "end": 64,
                          "start_line": 4,
                          "start_col": 18
                        }
                      }
                    },
                    "span": {
                      "start": 58,
                      "end": 64,
                      "start_line": 4,
                      "start_col": 18
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 78,
                      "end": 81,
                      "start_line": 4,
                      "start_col": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 87,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "ARRAY",
                  "visibility": null,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 93,
                          "end": 98,
                          "start_line": 5,
                          "start_col": 10
                        }
                      }
                    },
                    "span": {
                      "start": 93,
                      "end": 98,
                      "start_line": 5,
                      "start_col": 10
                    }
                  },
                  "value": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 107,
                      "end": 109,
                      "start_line": 5,
                      "start_col": 24
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 87,
                "end": 115,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "FOO",
                  "visibility": null,
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 121,
                                "end": 124,
                                "start_line": 6,
                                "start_col": 10
                              }
                            }
                          },
                          "span": {
                            "start": 121,
                            "end": 124,
                            "start_line": 6,
                            "start_col": 10
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Bar"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 125,
                                "end": 128,
                                "start_line": 6,
                                "start_col": 14
                              }
                            }
                          },
                          "span": {
                            "start": 125,
                            "end": 128,
                            "start_line": 6,
                            "start_col": 14
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
                                "start": 129,
                                "end": 133,
                                "start_line": 6,
                                "start_col": 18
                              }
                            }
                          },
                          "span": {
                            "start": 129,
                            "end": 133,
                            "start_line": 6,
                            "start_col": 18
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 121,
                      "end": 133,
                      "start_line": 6,
                      "start_col": 10
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 140,
                      "end": 144,
                      "start_line": 6,
                      "start_col": 29
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 115,
                "end": 146,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 147,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 147,
    "start_line": 1,
    "start_col": 0
  }
}

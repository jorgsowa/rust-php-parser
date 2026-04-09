===config===
min_php=8.3
===source===
<?php class A { const int X = 1; private const string Y = 'a'; const Foo|Bar|null Z = null; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                          "start": 22,
                          "end": 25,
                          "start_line": 1,
                          "start_col": 22
                        }
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 25,
                      "start_line": 1,
                      "start_col": 22
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31,
                      "start_line": 1,
                      "start_col": 30
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 33,
                "start_line": 1,
                "start_col": 16
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
                          "start": 47,
                          "end": 53,
                          "start_line": 1,
                          "start_col": 47
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 53,
                      "start_line": 1,
                      "start_col": 47
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 58,
                      "end": 61,
                      "start_line": 1,
                      "start_col": 58
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 63,
                "start_line": 1,
                "start_col": 33
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "Z",
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
                                "start": 69,
                                "end": 72,
                                "start_line": 1,
                                "start_col": 69
                              }
                            }
                          },
                          "span": {
                            "start": 69,
                            "end": 72,
                            "start_line": 1,
                            "start_col": 69
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
                                "start": 73,
                                "end": 76,
                                "start_line": 1,
                                "start_col": 73
                              }
                            }
                          },
                          "span": {
                            "start": 73,
                            "end": 76,
                            "start_line": 1,
                            "start_col": 73
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
                                "start": 77,
                                "end": 81,
                                "start_line": 1,
                                "start_col": 77
                              }
                            }
                          },
                          "span": {
                            "start": 77,
                            "end": 81,
                            "start_line": 1,
                            "start_col": 77
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 69,
                      "end": 81,
                      "start_line": 1,
                      "start_col": 69
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 86,
                      "end": 90,
                      "start_line": 1,
                      "start_col": 86
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 63,
                "end": 92,
                "start_line": 1,
                "start_col": 63
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 93,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93,
    "start_line": 1,
    "start_col": 0
  }
}

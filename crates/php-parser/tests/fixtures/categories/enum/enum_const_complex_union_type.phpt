===config===
min_php=8.3
===source===
<?php enum Config { const int|float|string VALUE = 1; const bool|null MAYBE = false; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Config",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "VALUE",
                  "visibility": null,
                  "is_final": false,
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
                                "start": 26,
                                "end": 29
                              }
                            }
                          },
                          "span": {
                            "start": 26,
                            "end": 29
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "float"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 30,
                                "end": 35
                              }
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 35
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
                                "end": 42
                              }
                            }
                          },
                          "span": {
                            "start": 36,
                            "end": 42
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 26,
                      "end": 42
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 51,
                      "end": 52
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 53
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "MAYBE",
                  "visibility": null,
                  "is_final": false,
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "bool"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 60,
                                "end": 64
                              }
                            }
                          },
                          "span": {
                            "start": 60,
                            "end": 64
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
                                "start": 65,
                                "end": 69
                              }
                            }
                          },
                          "span": {
                            "start": 65,
                            "end": 69
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 60,
                      "end": 69
                    }
                  },
                  "value": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 78,
                      "end": 83
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 84
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 86
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 86
  }
}

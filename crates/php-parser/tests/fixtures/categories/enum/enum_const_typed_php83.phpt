===source===
<?php enum Status { public const string MODE = 'fit'; const int|string MIXED = 42; }
===ast >=8.3===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "MODE",
                    "span": {
                      "start": 40,
                      "end": 44
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 39
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "fit"
                    },
                    "span": {
                      "start": 47,
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
                  "name": {
                    "name": "MIXED",
                    "span": {
                      "start": 71,
                      "end": 76
                    }
                  },
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
                                "start": 60,
                                "end": 63
                              }
                            }
                          },
                          "span": {
                            "start": 60,
                            "end": 63
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
                                "start": 64,
                                "end": 70
                              }
                            }
                          },
                          "span": {
                            "start": 64,
                            "end": 70
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 60,
                      "end": 70
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 79,
                      "end": 81
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 82
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 84
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 84
  }
}

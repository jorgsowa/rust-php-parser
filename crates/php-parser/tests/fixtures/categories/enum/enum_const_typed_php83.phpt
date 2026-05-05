===config===
min_php=8.3
===source===
<?php enum Status { public const string MODE = 'fit'; const int|string MIXED = 42; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "MODE",
                  "visibility": "Public",
                  "is_final": false,
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
                  "name": "MIXED",
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

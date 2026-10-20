===source===
<?php enum Config { const int|float|string VALUE = 1; const bool|null MAYBE = false; }
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Config" in Standard input code on line 1
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "|", expecting "=" in Standard input code on line 1
===ast >=8.3===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Config",
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
                    "name": "VALUE",
                    "span": {
                      "start": 43,
                      "end": 48
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
                  "name": {
                    "name": "MAYBE",
                    "span": {
                      "start": 70,
                      "end": 75
                    }
                  },
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

===source===
<?php enum Lists { const EMPTY = []; const NUMS = [1, 2, 3]; const ASSOC = ['a' => 1, 'b' => 2]; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Lists' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Lists" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Lists",
            "span": {
              "start": 11,
              "end": 16
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "EMPTY",
                    "span": {
                      "start": 25,
                      "end": 30
                    }
                  },
                  "value": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 33,
                      "end": 35
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 36
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "NUMS",
                    "span": {
                      "start": 43,
                      "end": 47
                    }
                  },
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 51,
                                "end": 52
                              }
                            }
                          },
                          "span": {
                            "start": 51,
                            "end": 52
                          }
                        },
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 2
                              },
                              "span": {
                                "start": 54,
                                "end": 55
                              }
                            }
                          },
                          "span": {
                            "start": 54,
                            "end": 55
                          }
                        },
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 3
                              },
                              "span": {
                                "start": 57,
                                "end": 58
                              }
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 58
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 50,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 60
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "ASSOC",
                    "span": {
                      "start": 67,
                      "end": 72
                    }
                  },
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "a"
                            },
                            "span": {
                              "start": 76,
                              "end": 79
                            }
                          },
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 83,
                                "end": 84
                              }
                            }
                          },
                          "span": {
                            "start": 76,
                            "end": 84
                          }
                        },
                        {
                          "key": {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 86,
                              "end": 89
                            }
                          },
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 2
                              },
                              "span": {
                                "start": 93,
                                "end": 94
                              }
                            }
                          },
                          "span": {
                            "start": 86,
                            "end": 94
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 75,
                      "end": 95
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 61,
                "end": 96
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 98
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 98
  }
}

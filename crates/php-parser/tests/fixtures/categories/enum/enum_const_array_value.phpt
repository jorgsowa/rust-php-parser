===config===
min_php=8.1
===source===
<?php enum Lists { const EMPTY = []; const NUMS = [1, 2, 3]; const ASSOC = ['a' => 1, 'b' => 2]; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Lists",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "EMPTY",
                  "visibility": null,
                  "is_final": false,
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
                  "name": "NUMS",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 51,
                              "end": 52
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 51,
                            "end": 52
                          }
                        },
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 54,
                              "end": 55
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 54,
                            "end": 55
                          }
                        },
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 57,
                              "end": 58
                            }
                          },
                          "unpack": false,
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
                  "name": "ASSOC",
                  "visibility": null,
                  "is_final": false,
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
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 83,
                              "end": 84
                            }
                          },
                          "unpack": false,
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
                          "value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 93,
                              "end": 94
                            }
                          },
                          "unpack": false,
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

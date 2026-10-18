===source===
<?php implode(', ', array_map('strtoupper', explode(' ', $str)));
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "implode"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": ", "
                    },
                    "span": {
                      "start": 14,
                      "end": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 18
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "array_map"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 20,
                                "end": 29
                              }
                            }
                          },
                          "span": {
                            "start": 20,
                            "end": 29
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "String": "strtoupper"
                              },
                              "span": {
                                "start": 30,
                                "end": 42
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 30,
                              "end": 42
                            }
                          },
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "explode"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 44,
                                          "end": 51
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 44,
                                      "end": 51
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "value": {
                                        "kind": {
                                          "String": " "
                                        },
                                        "span": {
                                          "start": 52,
                                          "end": 55
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 52,
                                        "end": 55
                                      }
                                    },
                                    {
                                      "name": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "str"
                                        },
                                        "span": {
                                          "start": 57,
                                          "end": 61
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 57,
                                        "end": 61
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 44,
                                "end": 62
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 44,
                              "end": 62
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 63
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 63
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 64
          }
        }
      },
      "span": {
        "start": 6,
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}

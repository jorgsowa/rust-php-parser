===source===
<?php array_map(strlen(...), array_filter($arr, is_string(...)));
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
                      "array_map"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "Function": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "strlen"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 16,
                                  "end": 22
                                }
                              }
                            },
                            "span": {
                              "start": 16,
                              "end": 22
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 27
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 27
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
                                "array_filter"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 29,
                                "end": 41
                              }
                            }
                          },
                          "span": {
                            "start": 29,
                            "end": 41
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 42,
                                "end": 46
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 42,
                              "end": 46
                            }
                          },
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "CallableCreate": {
                                  "kind": {
                                    "Function": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "is_string"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 48,
                                            "end": 57
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 48,
                                        "end": 57
                                      }
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 48,
                                "end": 62
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 48,
                              "end": 62
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 63
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 29,
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

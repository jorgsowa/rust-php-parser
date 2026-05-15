===config===
min_php=8.0
===source===
<?php
function test(
    string /* before pipe */ | int $x,
    float | /* after pipe */ int $y
): string | null {
    return null;
}

class Test {
    private string | int $prop;

    public function method(
        string /* param */ | int $param
    ): string | /* return union */ int {
        return $param;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 25,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 31
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 52,
                            "end": 55
                          }
                        }
                      },
                      "span": {
                        "start": 52,
                        "end": 55
                      }
                    }
                  ]
                },
                "span": {
                  "start": 25,
                  "end": 55
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 25,
                "end": 58
              }
            },
            {
              "name": "y",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "float"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 64,
                            "end": 69
                          }
                        }
                      },
                      "span": {
                        "start": 64,
                        "end": 69
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 89,
                            "end": 92
                          }
                        }
                      },
                      "span": {
                        "start": 89,
                        "end": 92
                      }
                    }
                  ]
                },
                "span": {
                  "start": 64,
                  "end": 92
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 64,
                "end": 95
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 126,
                    "end": 130
                  }
                }
              },
              "span": {
                "start": 119,
                "end": 131
              }
            }
          ],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "string"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 99,
                        "end": 105
                      }
                    }
                  },
                  "span": {
                    "start": 99,
                    "end": 105
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
                        "start": 108,
                        "end": 112
                      }
                    }
                  },
                  "span": {
                    "start": 108,
                    "end": 112
                  }
                }
              ]
            },
            "span": {
              "start": 99,
              "end": 112
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 133
      }
    },
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
                "Property": {
                  "name": "prop",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "string"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 160,
                                "end": 166
                              }
                            }
                          },
                          "span": {
                            "start": 160,
                            "end": 166
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 169,
                                "end": 172
                              }
                            }
                          },
                          "span": {
                            "start": 169,
                            "end": 172
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 160,
                      "end": 172
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 152,
                "end": 178
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "method",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "param",
                      "type_hint": {
                        "kind": {
                          "Union": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "string"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 217,
                                    "end": 223
                                  }
                                }
                              },
                              "span": {
                                "start": 217,
                                "end": 223
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "int"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 238,
                                    "end": 241
                                  }
                                }
                              },
                              "span": {
                                "start": 238,
                                "end": 241
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 217,
                          "end": 241
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 217,
                        "end": 248
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "string"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 256,
                                "end": 262
                              }
                            }
                          },
                          "span": {
                            "start": 256,
                            "end": 262
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 284,
                                "end": 287
                              }
                            }
                          },
                          "span": {
                            "start": 284,
                            "end": 287
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 256,
                      "end": 287
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Variable": "param"
                          },
                          "span": {
                            "start": 305,
                            "end": 311
                          }
                        }
                      },
                      "span": {
                        "start": 298,
                        "end": 312
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 185,
                "end": 318
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 135,
        "end": 320
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 320
  }
}

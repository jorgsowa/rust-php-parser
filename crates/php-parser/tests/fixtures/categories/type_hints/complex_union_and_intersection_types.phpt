===source===
<?php
function processData(Countable&ArrayAccess $data): array|null {
    return null;
}
class Container {
    public function __construct(
        public readonly Countable&Iterator $items,
        private string|int|float $value
    ) {}
}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "ArrayAccess", expecting variable in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "processData",
            "span": {
              "start": 15,
              "end": 26
            }
          },
          "params": [
            {
              "name": {
                "name": "data",
                "span": {
                  "start": 49,
                  "end": 54
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Countable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 27,
                            "end": 36
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 36
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "ArrayAccess"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 37,
                            "end": 48
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 48
                      }
                    }
                  ]
                },
                "span": {
                  "start": 27,
                  "end": 48
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 27,
                "end": 54
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 81,
                    "end": 85
                  }
                }
              },
              "span": {
                "start": 74,
                "end": 86
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
                        "array"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 57,
                        "end": 62
                      }
                    }
                  },
                  "span": {
                    "start": 57,
                    "end": 62
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
                        "start": 63,
                        "end": 67
                      }
                    }
                  },
                  "span": {
                    "start": 63,
                    "end": 67
                  }
                }
              ]
            },
            "span": {
              "start": 57,
              "end": 67
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 88
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Container",
            "span": {
              "start": 95,
              "end": 104
            }
          },
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 127,
                      "end": 138
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "items",
                        "span": {
                          "start": 183,
                          "end": 189
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Intersection": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Countable"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 164,
                                    "end": 173
                                  }
                                }
                              },
                              "span": {
                                "start": 164,
                                "end": 173
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Iterator"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 174,
                                    "end": 182
                                  }
                                }
                              },
                              "span": {
                                "start": 174,
                                "end": 182
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 164,
                          "end": 182
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 148,
                        "end": 189
                      }
                    },
                    {
                      "name": {
                        "name": "value",
                        "span": {
                          "start": 224,
                          "end": 230
                        }
                      },
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
                                    "start": 207,
                                    "end": 213
                                  }
                                }
                              },
                              "span": {
                                "start": 207,
                                "end": 213
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
                                    "start": 214,
                                    "end": 217
                                  }
                                }
                              },
                              "span": {
                                "start": 214,
                                "end": 217
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
                                    "start": 218,
                                    "end": 223
                                  }
                                }
                              },
                              "span": {
                                "start": 218,
                                "end": 223
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 207,
                          "end": 223
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 199,
                        "end": 230
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 111,
                "end": 239
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 89,
        "end": 241
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 241
  }
}

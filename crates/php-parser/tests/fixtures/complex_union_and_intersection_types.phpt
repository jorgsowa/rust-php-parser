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
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "processData",
          "params": [
            {
              "name": "data",
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
                            "end": 36,
                            "start_line": 2,
                            "start_col": 21
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 36,
                        "start_line": 2,
                        "start_col": 21
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
                            "end": 49,
                            "start_line": 2,
                            "start_col": 31
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 49,
                        "start_line": 2,
                        "start_col": 31
                      }
                    }
                  ]
                },
                "span": {
                  "start": 27,
                  "end": 49,
                  "start_line": 2,
                  "start_col": 21
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
                "start": 27,
                "end": 54,
                "start_line": 2,
                "start_col": 21
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
                    "end": 85,
                    "start_line": 3,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 74,
                "end": 87,
                "start_line": 3,
                "start_col": 4
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
                        "end": 62,
                        "start_line": 2,
                        "start_col": 51
                      }
                    }
                  },
                  "span": {
                    "start": 57,
                    "end": 62,
                    "start_line": 2,
                    "start_col": 51
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
                        "end": 67,
                        "start_line": 2,
                        "start_col": 57
                      }
                    }
                  },
                  "span": {
                    "start": 63,
                    "end": 67,
                    "start_line": 2,
                    "start_col": 57
                  }
                }
              ]
            },
            "span": {
              "start": 57,
              "end": 67,
              "start_line": 2,
              "start_col": 51
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 88,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Container",
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
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "items",
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
                                    "end": 173,
                                    "start_line": 7,
                                    "start_col": 24
                                  }
                                }
                              },
                              "span": {
                                "start": 164,
                                "end": 173,
                                "start_line": 7,
                                "start_col": 24
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
                                    "end": 183,
                                    "start_line": 7,
                                    "start_col": 34
                                  }
                                }
                              },
                              "span": {
                                "start": 174,
                                "end": 183,
                                "start_line": 7,
                                "start_col": 34
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 164,
                          "end": 183,
                          "start_line": 7,
                          "start_col": 24
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": true,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 148,
                        "end": 189,
                        "start_line": 7,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "value",
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
                                    "end": 213,
                                    "start_line": 8,
                                    "start_col": 16
                                  }
                                }
                              },
                              "span": {
                                "start": 207,
                                "end": 213,
                                "start_line": 8,
                                "start_col": 16
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
                                    "end": 217,
                                    "start_line": 8,
                                    "start_col": 23
                                  }
                                }
                              },
                              "span": {
                                "start": 214,
                                "end": 217,
                                "start_line": 8,
                                "start_col": 23
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
                                    "end": 223,
                                    "start_line": 8,
                                    "start_col": 27
                                  }
                                }
                              },
                              "span": {
                                "start": 218,
                                "end": 223,
                                "start_line": 8,
                                "start_col": 27
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 207,
                          "end": 223,
                          "start_line": 8,
                          "start_col": 16
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 199,
                        "end": 230,
                        "start_line": 8,
                        "start_col": 8
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
                "end": 240,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 89,
        "end": 241,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 241,
    "start_line": 1,
    "start_col": 0
  }
}

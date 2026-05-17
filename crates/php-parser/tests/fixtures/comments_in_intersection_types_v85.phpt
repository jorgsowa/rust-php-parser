===config===
min_php=8.5
===source===
<?php
function test(
    /* intersection */ (Countable & Traversable) $x
): Countable & Traversable {
    return $x;
}

class Test {
    private Countable & Traversable $prop;

    public function method(
        Countable & /* comment */ Traversable $param
    ): Countable & Traversable {
        return $param;
    }
}
===errors===
A parenthesized intersection type can only be used as part of a union type
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
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Countable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 45,
                            "end": 54
                          }
                        }
                      },
                      "span": {
                        "start": 45,
                        "end": 54
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Traversable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 57,
                            "end": 68
                          }
                        }
                      },
                      "span": {
                        "start": 57,
                        "end": 68
                      }
                    }
                  ]
                },
                "span": {
                  "start": 44,
                  "end": 69
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
                "start": 44,
                "end": 72
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 113,
                    "end": 115
                  }
                }
              },
              "span": {
                "start": 106,
                "end": 116
              }
            }
          ],
          "return_type": {
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
                        "start": 76,
                        "end": 85
                      }
                    }
                  },
                  "span": {
                    "start": 76,
                    "end": 85
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Traversable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 88,
                        "end": 99
                      }
                    }
                  },
                  "span": {
                    "start": 88,
                    "end": 99
                  }
                }
              ]
            },
            "span": {
              "start": 76,
              "end": 99
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 118
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
                      "Intersection": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Countable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 145,
                                "end": 154
                              }
                            }
                          },
                          "span": {
                            "start": 145,
                            "end": 154
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Traversable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 157,
                                "end": 168
                              }
                            }
                          },
                          "span": {
                            "start": 157,
                            "end": 168
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 145,
                      "end": 168
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 137,
                "end": 174
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
                          "Intersection": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Countable"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 213,
                                    "end": 222
                                  }
                                }
                              },
                              "span": {
                                "start": 213,
                                "end": 222
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Traversable"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 239,
                                    "end": 250
                                  }
                                }
                              },
                              "span": {
                                "start": 239,
                                "end": 250
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 213,
                          "end": 250
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
                        "start": 213,
                        "end": 257
                      }
                    }
                  ],
                  "return_type": {
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
                                "start": 265,
                                "end": 274
                              }
                            }
                          },
                          "span": {
                            "start": 265,
                            "end": 274
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Traversable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 277,
                                "end": 288
                              }
                            }
                          },
                          "span": {
                            "start": 277,
                            "end": 288
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 265,
                      "end": 288
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
                            "start": 306,
                            "end": 312
                          }
                        }
                      },
                      "span": {
                        "start": 299,
                        "end": 313
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 181,
                "end": 319
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 120,
        "end": 321
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 321
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected variable "$x", expecting "|" in Standard input code on line 3

===source===
<?php
namespace N1 {
    use A\B as never;
}
namespace N2 {
    class never {}
    interface Never {}
    class A extends never {}
    function f(never $a, ?never $b, never|int $c): never { return $a; }
    function g(): Foo\never {}
    function h(\never $a, namespace\never $b) {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===errors >=8.1===
Cannot use A\B as never because 'never' is a special class name
Cannot use "never" as a class name as it is reserved
Cannot use "Never" as an interface name as it is reserved
never cannot be used as a parameter type
never can only be used as a standalone type
never can only be used as a standalone type
A never-returning function must not return
Cannot use "N2\Foo\never" as a type name as it is reserved
Type declaration 'never' must be unqualified
Type declaration 'never' must be unqualified
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 9
===php_error >=8.1===
PHP Fatal error:  Cannot use A\B as never because 'never' is a special class name in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N1"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 18
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "A",
                            "B"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 29,
                            "end": 32
                          }
                        },
                        "alias": {
                          "name": "never",
                          "span": {
                            "start": 36,
                            "end": 41
                          }
                        },
                        "span": {
                          "start": 29,
                          "end": 41
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 25,
                  "end": 42
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N2"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 55,
              "end": 57
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "never",
                      "span": {
                        "start": 70,
                        "end": 75
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 64,
                  "end": 78
                }
              },
              {
                "kind": {
                  "Interface": {
                    "name": {
                      "name": "Never",
                      "span": {
                        "start": 93,
                        "end": 98
                      }
                    },
                    "extends": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 83,
                  "end": 101
                }
              },
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "A",
                      "span": {
                        "start": 112,
                        "end": 113
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "never"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 122,
                        "end": 127
                      }
                    },
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 106,
                  "end": 130
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 144,
                        "end": 145
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 152,
                            "end": 154
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "never"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 146,
                                "end": 151
                              }
                            }
                          },
                          "span": {
                            "start": 146,
                            "end": 151
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 146,
                          "end": 154
                        }
                      },
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 163,
                            "end": 165
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Nullable": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "never"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 157,
                                    "end": 162
                                  }
                                }
                              },
                              "span": {
                                "start": 157,
                                "end": 162
                              }
                            }
                          },
                          "span": {
                            "start": 156,
                            "end": 162
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 156,
                          "end": 165
                        }
                      },
                      {
                        "name": {
                          "name": "c",
                          "span": {
                            "start": 177,
                            "end": 179
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Union": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "never"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 167,
                                      "end": 172
                                    }
                                  }
                                },
                                "span": {
                                  "start": 167,
                                  "end": 172
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
                                      "start": 173,
                                      "end": 176
                                    }
                                  }
                                },
                                "span": {
                                  "start": 173,
                                  "end": 176
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 167,
                            "end": 176
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 167,
                          "end": 179
                        }
                      }
                    ],
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 197,
                              "end": 199
                            }
                          }
                        },
                        "span": {
                          "start": 190,
                          "end": 200
                        }
                      }
                    ],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "never"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 182,
                            "end": 187
                          }
                        }
                      },
                      "span": {
                        "start": 182,
                        "end": 187
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 135,
                  "end": 202
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "g",
                      "span": {
                        "start": 216,
                        "end": 217
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Foo",
                            "never"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 221,
                            "end": 230
                          }
                        }
                      },
                      "span": {
                        "start": 221,
                        "end": 230
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 207,
                  "end": 233
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "h",
                      "span": {
                        "start": 247,
                        "end": 248
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 256,
                            "end": 258
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "never"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 249,
                                "end": 255
                              }
                            }
                          },
                          "span": {
                            "start": 249,
                            "end": 255
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 249,
                          "end": 258
                        }
                      },
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 276,
                            "end": 278
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "never"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 260,
                                "end": 275
                              }
                            }
                          },
                          "span": {
                            "start": 260,
                            "end": 275
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 260,
                          "end": 278
                        }
                      }
                    ],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 238,
                  "end": 282
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 45,
        "end": 284
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 284
  }
}

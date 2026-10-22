===source===
<?php
class A {
    function __construct(public int ...$a) {}
}
class B {
    function __construct(private readonly int ...$b) {}
}
class C {
    function __construct(public array $hooked { get => []; }, ...$ok) {}
}
class D {
    function __construct(public ...$d { get => []; }) {}
}
class E {
    function __construct(...$ok) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
Cannot declare variadic promoted property
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
Cannot declare variadic promoted property
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
Cannot declare variadic promoted property
===errors 8.0===
Cannot declare variadic promoted property
'readonly parameters' requires PHP 8.1 or higher
Cannot declare variadic promoted property
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
Cannot declare variadic promoted property
===errors 8.1-8.3===
Cannot declare variadic promoted property
Cannot declare variadic promoted property
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
Cannot declare variadic promoted property
===errors >=8.4===
Cannot declare variadic promoted property
Cannot declare variadic promoted property
Cannot declare variadic promoted property
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 6
===php_error 8.1-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 9
===php_error >=8.4===
PHP Fatal error:  Cannot declare variadic promoted property in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
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
                      "start": 29,
                      "end": 40
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 55,
                          "end": 57
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 48,
                              "end": 51
                            }
                          }
                        },
                        "span": {
                          "start": 48,
                          "end": 51
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 41,
                        "end": 57
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 70,
              "end": 71
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
                      "start": 87,
                      "end": 98
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 123,
                          "end": 125
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 116,
                              "end": 119
                            }
                          }
                        },
                        "span": {
                          "start": 116,
                          "end": 119
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "modifiers": {
                        "visibility": "Private",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 99,
                        "end": 125
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 78,
                "end": 129
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 64,
        "end": 131
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 138,
              "end": 139
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
                      "start": 155,
                      "end": 166
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "hooked",
                        "span": {
                          "start": 180,
                          "end": 187
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 174,
                              "end": 179
                            }
                          }
                        },
                        "span": {
                          "start": 174,
                          "end": 179
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Array": []
                              },
                              "span": {
                                "start": 197,
                                "end": 199
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 190,
                            "end": 200
                          }
                        }
                      ],
                      "span": {
                        "start": 167,
                        "end": 202
                      }
                    },
                    {
                      "name": {
                        "name": "ok",
                        "span": {
                          "start": 207,
                          "end": 210
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "attributes": [],
                      "span": {
                        "start": 204,
                        "end": 210
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 146,
                "end": 214
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 132,
        "end": 216
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 223,
              "end": 224
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
                      "start": 240,
                      "end": 251
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "d",
                        "span": {
                          "start": 262,
                          "end": 264
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Array": []
                              },
                              "span": {
                                "start": 274,
                                "end": 276
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 267,
                            "end": 277
                          }
                        }
                      ],
                      "span": {
                        "start": 252,
                        "end": 279
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 231,
                "end": 283
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 217,
        "end": 285
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "E",
            "span": {
              "start": 292,
              "end": 293
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
                      "start": 309,
                      "end": 320
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "ok",
                        "span": {
                          "start": 324,
                          "end": 327
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "attributes": [],
                      "span": {
                        "start": 321,
                        "end": 327
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 300,
                "end": 331
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 286,
        "end": 333
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 333
  }
}

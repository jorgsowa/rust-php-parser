===source===
<?php
readonly class C {
    public $a;
    public int $b;
    public function __construct(public $c, public int $d, $e) {}
}
$x = new readonly class { public $f; };
===errors <=7.4===
'readonly class' requires PHP 8.2 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
readonly property must have type
readonly property must have type
'readonly anonymous classes' requires PHP 8.3 or higher
readonly property must have type
===errors 8.0-8.1===
'readonly class' requires PHP 8.2 or higher
readonly property must have type
readonly property must have type
'readonly anonymous classes' requires PHP 8.3 or higher
readonly property must have type
===errors 8.2===
readonly property must have type
readonly property must have type
'readonly anonymous classes' requires PHP 8.3 or higher
readonly property must have type
===errors >=8.3===
readonly property must have type
readonly property must have type
readonly property must have type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===php_error 8.2===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 7
===php_error >=8.3===
PHP Fatal error:  Readonly property C::$a must have type in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 38
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 55,
                      "end": 57
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 51,
                          "end": 54
                        }
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 54
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 44,
                "end": 57
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 79,
                      "end": 90
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "c",
                        "span": {
                          "start": 98,
                          "end": 100
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 91,
                        "end": 100
                      }
                    },
                    {
                      "name": {
                        "name": "d",
                        "span": {
                          "start": 113,
                          "end": 115
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
                              "start": 109,
                              "end": 112
                            }
                          }
                        },
                        "span": {
                          "start": 109,
                          "end": 112
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 102,
                        "end": 115
                      }
                    },
                    {
                      "name": {
                        "name": "e",
                        "span": {
                          "start": 117,
                          "end": 119
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 117,
                        "end": 119
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 63,
                "end": 123
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 125
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 126,
                  "end": 128
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": true
                          },
                          "extends": null,
                          "implements": [],
                          "members": [
                            {
                              "kind": {
                                "Property": {
                                  "name": {
                                    "name": "f",
                                    "span": {
                                      "start": 159,
                                      "end": 161
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Public"
                                  },
                                  "type_hint": null,
                                  "default": null,
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 152,
                                "end": 161
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 131,
                        "end": 164
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 131,
                  "end": 164
                }
              }
            }
          },
          "span": {
            "start": 126,
            "end": 164
          }
        }
      },
      "span": {
        "start": 126,
        "end": 165
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 165
  }
}

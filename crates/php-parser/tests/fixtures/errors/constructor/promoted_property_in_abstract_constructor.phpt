===source===
<?php
abstract class A {
    abstract public function __construct(public $a, $b, private readonly int $c, protected(set) string $d);
}
interface I {
    public function __Construct(public $a);
}
trait T {
    abstract function __construct(public $a { get => 1; });
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
'asymmetric visibility' requires PHP 8.4 or higher
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
'constructor property promotion' requires PHP 8.0 or higher
Cannot declare promoted property in an abstract constructor
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
Cannot declare promoted property in an abstract constructor
===errors 8.0===
'readonly parameters' requires PHP 8.1 or higher
'asymmetric visibility' requires PHP 8.4 or higher
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
'property hooks' requires PHP 8.4 or higher
Cannot declare promoted property in an abstract constructor
===errors 8.1-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
'property hooks' requires PHP 8.4 or higher
Cannot declare promoted property in an abstract constructor
===errors >=8.4===
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
Cannot declare promoted property in an abstract constructor
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 3
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 3
===php_error 8.2-8.3===
PHP Parse error:  syntax error, unexpected token ")", expecting amp in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot declare promoted property in an abstract constructor in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                      "start": 54,
                      "end": 65
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 73,
                          "end": 75
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
                        "start": 66,
                        "end": 75
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 77,
                          "end": 79
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 77,
                        "end": 79
                      }
                    },
                    {
                      "name": {
                        "name": "c",
                        "span": {
                          "start": 102,
                          "end": 104
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
                              "start": 98,
                              "end": 101
                            }
                          }
                        },
                        "span": {
                          "start": 98,
                          "end": 101
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 81,
                        "end": 104
                      }
                    },
                    {
                      "name": {
                        "name": "d",
                        "span": {
                          "start": 128,
                          "end": 130
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 121,
                              "end": 127
                            }
                          }
                        },
                        "span": {
                          "start": 121,
                          "end": 127
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "set_visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 106,
                        "end": 130
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 132
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 134
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 145,
              "end": 146
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__Construct",
                    "span": {
                      "start": 169,
                      "end": 180
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 188,
                          "end": 190
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
                        "start": 181,
                        "end": 190
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 153,
                "end": 192
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 135,
        "end": 194
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 201,
              "end": 202
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 227,
                      "end": 238
                    }
                  },
                  "modifiers": {
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 246,
                          "end": 248
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
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 258,
                                "end": 259
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 251,
                            "end": 260
                          }
                        }
                      ],
                      "span": {
                        "start": 239,
                        "end": 262
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 209,
                "end": 264
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 195,
        "end": 266
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 266
  }
}

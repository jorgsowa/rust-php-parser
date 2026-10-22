===source===
<?php
class A {
    public function __construct(public int $x { get => 1; }, private $y { set => $value; }) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 3
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
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 59,
                          "end": 61
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
                              "start": 55,
                              "end": 58
                            }
                          }
                        },
                        "span": {
                          "start": 55,
                          "end": 58
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
                                "Int": 1
                              },
                              "span": {
                                "start": 71,
                                "end": 72
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 64,
                            "end": 73
                          }
                        }
                      ],
                      "span": {
                        "start": 48,
                        "end": 75
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 85,
                          "end": 87
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Set",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Variable": "value"
                              },
                              "span": {
                                "start": 97,
                                "end": 103
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 90,
                            "end": 104
                          }
                        }
                      ],
                      "span": {
                        "start": 77,
                        "end": 106
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
                "end": 110
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 112
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112
  }
}

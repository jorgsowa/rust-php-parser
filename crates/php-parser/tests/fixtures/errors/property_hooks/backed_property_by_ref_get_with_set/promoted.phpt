===source===
<?php
class A {
    public function __construct(public $f { &get => $this->f; set => $value; }) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
Get hook of backed property A::f with set hook may not return by reference
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
Get hook of backed property A::f with set hook may not return by reference
===errors >=8.4===
Get hook of backed property A::f with set hook may not return by reference
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Get hook of backed property A::f with set hook may not return by reference in Standard input code on line 3
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
                        "name": "f",
                        "span": {
                          "start": 55,
                          "end": 57
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
                                "PropertyAccess": {
                                  "object": {
                                    "kind": {
                                      "Variable": "this"
                                    },
                                    "span": {
                                      "start": 68,
                                      "end": 73
                                    }
                                  },
                                  "property": {
                                    "kind": {
                                      "Identifier": "f"
                                    },
                                    "span": {
                                      "start": 75,
                                      "end": 76
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 68,
                                "end": 76
                              }
                            }
                          },
                          "by_ref": true,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 60,
                            "end": 77
                          }
                        },
                        {
                          "kind": "Set",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Variable": "value"
                              },
                              "span": {
                                "start": 85,
                                "end": 91
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 78,
                            "end": 92
                          }
                        }
                      ],
                      "span": {
                        "start": 48,
                        "end": 94
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
                "end": 98
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 100
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 100
  }
}

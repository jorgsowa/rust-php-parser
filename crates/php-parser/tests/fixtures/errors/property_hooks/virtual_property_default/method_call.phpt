===source===
<?php
class A {
    public $f = 1 { get => $this->f(); }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property A::$f
===errors >=8.4===
Cannot specify default value for virtual hooked property A::$f
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property A::$f in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 43,
                                  "end": 48
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "f"
                                },
                                "span": {
                                  "start": 50,
                                  "end": 51
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 53
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 54
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}

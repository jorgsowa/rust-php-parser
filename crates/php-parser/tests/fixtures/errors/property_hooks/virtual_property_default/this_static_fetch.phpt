===source===
<?php
class A {
    public $i = 1 { get => $this::$i; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property A::$i
===errors >=8.4===
Cannot specify default value for virtual hooked property A::$i
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property A::$i in Standard input code on line 3
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
                    "name": "i",
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
                            "StaticPropertyAccess": {
                              "class": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 43,
                                  "end": 48
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "i"
                                },
                                "span": {
                                  "start": 50,
                                  "end": 52
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 52
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 53
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 55
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}

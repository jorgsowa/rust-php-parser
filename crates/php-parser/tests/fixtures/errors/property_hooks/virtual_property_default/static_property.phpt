===source===
<?php
class A {
    public $g = 1 { get => self::$g; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property A::$g
===errors >=8.4===
Cannot specify default value for virtual hooked property A::$g
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property A::$g in Standard input code on line 3
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
                    "name": "g",
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
                                  "Name": {
                                    "parts": [
                                      "self"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 43,
                                      "end": 47
                                    }
                                  }
                                },
                                "span": {
                                  "start": 43,
                                  "end": 47
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "g"
                                },
                                "span": {
                                  "start": 49,
                                  "end": 51
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 51
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 52
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 54
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}

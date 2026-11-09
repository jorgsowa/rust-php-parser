===source===
<?php
class A {
    public $c { get => parent::X; }
}
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
Cannot use "parent" when current class scope has no parent
===errors >=8.4===
Cannot use "parent" when current class scope has no parent
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 3
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
                    "name": "c",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 39,
                                      "end": 45
                                    }
                                  }
                                },
                                "span": {
                                  "start": 39,
                                  "end": 45
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "X"
                                },
                                "span": {
                                  "start": 47,
                                  "end": 48
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 39,
                            "end": 48
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 49
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 51
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}

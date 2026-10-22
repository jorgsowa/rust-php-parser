===source===
<?php
class C { public $p { &get { return $this?->q; } } }
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
Cannot take reference of a nullsafe chain
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
Cannot take reference of a nullsafe chain
===errors >=8.4===
Cannot take reference of a nullsafe chain
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot take reference of a nullsafe chain in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "p",
                    "span": {
                      "start": 23,
                      "end": 25
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
                        "Block": [
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "NullsafePropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 42,
                                        "end": 47
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "q"
                                      },
                                      "span": {
                                        "start": 50,
                                        "end": 51
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 42,
                                  "end": 51
                                }
                              }
                            },
                            "span": {
                              "start": 35,
                              "end": 52
                            }
                          }
                        ]
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 28,
                        "end": 54
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
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

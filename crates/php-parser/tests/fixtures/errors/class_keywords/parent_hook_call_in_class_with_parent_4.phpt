===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A extends B { public $a { get => parent::$b::get(); } }
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Must not use parent::$b::get() in a different property ($a)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 1
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 1
===php_error >=8.4===
PHP Fatal error:  Must not use parent::$b::get() in a different property ($a) in Standard input code on line 1
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
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 33,
                      "end": 35
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
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 45,
                                            "end": 51
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 45,
                                        "end": 51
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "b"
                                      },
                                      "span": {
                                        "start": 53,
                                        "end": 55
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 45,
                                  "end": 55
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 57,
                                  "end": 60
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 45,
                            "end": 62
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 38,
                        "end": 63
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 26,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}

===source===
<?php
class A extends B {
    public $a {
        get => parent::$b::get();
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Must not use parent::$b::get() in a different property ($a)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Must not use parent::$b::get() in a different property ($a) in Standard input code on line 4
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
                      "start": 37,
                      "end": 39
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
                                            "start": 57,
                                            "end": 63
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 57,
                                        "end": 63
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "b"
                                      },
                                      "span": {
                                        "start": 65,
                                        "end": 67
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 57,
                                  "end": 67
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 69,
                                  "end": 72
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 74
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 75
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 81
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 83
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 83
  }
}

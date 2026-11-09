===source===
<?php
class A extends B {
    public $a {
        get => parent::${0}::get();
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Must not use parent::$0::get() in a different property ($a)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Must not use parent::$0::get() in a different property ($a) in Standard input code on line 4
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
                                  "StaticPropertyAccessDynamic": {
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
                                        "VariableVariable": {
                                          "kind": {
                                            "Int": 0
                                          },
                                          "span": {
                                            "start": 67,
                                            "end": 68
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 65,
                                        "end": 69
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 57,
                                  "end": 69
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 71,
                                  "end": 74
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 76
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 77
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 83
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 85
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 85
  }
}

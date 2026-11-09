===source===
<?php
class A extends B {
    public $a {
        set {
            parent::$a::get();
        }
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Must not use parent::$a::get() in a different property hook (set)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Must not use parent::$a::get() in a different property hook (set) in Standard input code on line 5
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
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
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
                                                  "start": 68,
                                                  "end": 74
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 68,
                                              "end": 74
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "a"
                                            },
                                            "span": {
                                              "start": 76,
                                              "end": 78
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 68,
                                        "end": 78
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "get"
                                      },
                                      "span": {
                                        "start": 80,
                                        "end": 83
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 68,
                                  "end": 85
                                }
                              }
                            },
                            "span": {
                              "start": 68,
                              "end": 86
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 96
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 102
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 104
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104
  }
}

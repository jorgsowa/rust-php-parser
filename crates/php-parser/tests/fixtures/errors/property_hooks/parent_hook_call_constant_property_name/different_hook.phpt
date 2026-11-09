===source===
<?php
class A extends B {
    public $a {
        set {
            parent::${"a"}::get();
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
                                        "StaticPropertyAccessDynamic": {
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
                                              "VariableVariable": {
                                                "kind": {
                                                  "String": "a"
                                                },
                                                "span": {
                                                  "start": 78,
                                                  "end": 81
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 76,
                                              "end": 82
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 68,
                                        "end": 82
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "get"
                                      },
                                      "span": {
                                        "start": 84,
                                        "end": 87
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 68,
                                  "end": 89
                                }
                              }
                            },
                            "span": {
                              "start": 68,
                              "end": 90
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 100
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 106
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 108
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 108
  }
}

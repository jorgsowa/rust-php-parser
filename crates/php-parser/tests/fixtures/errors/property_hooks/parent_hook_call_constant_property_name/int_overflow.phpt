===source===
<?php
class A extends B {
    public $a {
        set {
            parent::${9223372036854775808}::set($value);
        }
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Must not use parent::$9.2233720368548E+18::set() in a different property ($a)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Must not use parent::$9.2233720368548E+18::set() in a different property ($a) in Standard input code on line 5
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
                                                  "Float": 9.223372036854776e+18
                                                },
                                                "span": {
                                                  "start": 78,
                                                  "end": 97
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 76,
                                              "end": 98
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 68,
                                        "end": 98
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 100,
                                        "end": 103
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 104,
                                              "end": 110
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 104,
                                          "end": 110
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 68,
                                  "end": 111
                                }
                              }
                            },
                            "span": {
                              "start": 68,
                              "end": 112
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 122
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 128
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 130
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 130
  }
}

===source===
<?php
class A extends B {
    public $a {
        set {
            $g = parent::$a::set(...);
        }
    }
}
===errors <=8.0===
'property hooks' requires PHP 8.4 or higher
'first-class callable syntax' requires PHP 8.1 or higher
===errors 8.1-8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Cannot create Closure for parent property hook call
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot create Closure for parent property hook call in Standard input code on line 5
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
                                  "Assign": {
                                    "target": {
                                      "kind": {
                                        "Variable": "g"
                                      },
                                      "span": {
                                        "start": 68,
                                        "end": 70
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "CallableCreate": {
                                          "kind": {
                                            "StaticMethod": {
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
                                                            "start": 73,
                                                            "end": 79
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 73,
                                                        "end": 79
                                                      }
                                                    },
                                                    "member": {
                                                      "kind": {
                                                        "Identifier": "a"
                                                      },
                                                      "span": {
                                                        "start": 81,
                                                        "end": 83
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 73,
                                                  "end": 83
                                                }
                                              },
                                              "method": {
                                                "kind": {
                                                  "Identifier": "set"
                                                },
                                                "span": {
                                                  "start": 85,
                                                  "end": 88
                                                }
                                              }
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 73,
                                        "end": 93
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 68,
                                  "end": 93
                                }
                              }
                            },
                            "span": {
                              "start": 68,
                              "end": 94
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 104
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 110
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 112
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112
  }
}

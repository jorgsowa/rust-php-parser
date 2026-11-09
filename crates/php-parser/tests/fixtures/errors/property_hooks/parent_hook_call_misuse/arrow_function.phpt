===source===
<?php
class A extends B {
    public $a {
        set {
            $f = fn() => parent::$a::set($value);
        }
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Must not use parent::$a::set() outside a property hook
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Must not use parent::$a::set() outside a property hook in Standard input code on line 5
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
                                        "Variable": "f"
                                      },
                                      "span": {
                                        "start": 68,
                                        "end": 70
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "ArrowFunction": {
                                          "is_static": false,
                                          "by_ref": false,
                                          "params": [],
                                          "return_type": null,
                                          "body": {
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
                                                              "start": 81,
                                                              "end": 87
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 81,
                                                          "end": 87
                                                        }
                                                      },
                                                      "member": {
                                                        "kind": {
                                                          "Identifier": "a"
                                                        },
                                                        "span": {
                                                          "start": 89,
                                                          "end": 91
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 81,
                                                    "end": 91
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "set"
                                                  },
                                                  "span": {
                                                    "start": 93,
                                                    "end": 96
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
                                                          "start": 97,
                                                          "end": 103
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 97,
                                                      "end": 103
                                                    }
                                                  }
                                                ]
                                              }
                                            },
                                            "span": {
                                              "start": 81,
                                              "end": 104
                                            }
                                          },
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 73,
                                        "end": 104
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 68,
                                  "end": 104
                                }
                              }
                            },
                            "span": {
                              "start": 68,
                              "end": 105
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 115
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 121
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 123
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 123
  }
}

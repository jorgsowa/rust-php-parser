===source===
<?php
class A {
    public $a = 1 { get => 2; }
}
trait T {
    public $b = 1 { get => 2; }
}
$o = new class {
    public $c = 1 { get => 2; }
};
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property A::$a
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property T::$b
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property class@anonymous::$c
===errors >=8.4===
Cannot specify default value for virtual hooked property A::$a
Cannot specify default value for virtual hooked property T::$b
Cannot specify default value for virtual hooked property class@anonymous::$c
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property A::$a in Standard input code on line 3
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
                    "name": "a",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 43,
                            "end": 44
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 45
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 56,
              "end": 57
            }
          },
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 71,
                      "end": 73
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 76,
                      "end": 77
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 87,
                            "end": 88
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 80,
                        "end": 89
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 64,
                "end": 91
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 50,
        "end": 93
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 94,
                  "end": 96
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
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
                                      "start": 122,
                                      "end": 124
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Public"
                                  },
                                  "type_hint": null,
                                  "default": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 127,
                                      "end": 128
                                    }
                                  },
                                  "attributes": [],
                                  "hooks": [
                                    {
                                      "kind": "Get",
                                      "body": {
                                        "Expression": {
                                          "kind": {
                                            "Int": 2
                                          },
                                          "span": {
                                            "start": 138,
                                            "end": 139
                                          }
                                        }
                                      },
                                      "by_ref": false,
                                      "params": [],
                                      "attributes": [],
                                      "span": {
                                        "start": 131,
                                        "end": 140
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 115,
                                "end": 142
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 99,
                        "end": 144
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 99,
                  "end": 144
                }
              }
            }
          },
          "span": {
            "start": 94,
            "end": 144
          }
        }
      },
      "span": {
        "start": 94,
        "end": 145
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 145
  }
}

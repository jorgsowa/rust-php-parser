===source===
<?php
class A {
    public $l = 1 { get => new class { public $m; function f() { return $this->l; } }; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property A::$l
===errors >=8.4===
Cannot specify default value for virtual hooked property A::$l
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property A::$l in Standard input code on line 3
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
                    "name": "l",
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
                                              "name": "m",
                                              "span": {
                                                "start": 62,
                                                "end": 64
                                              }
                                            },
                                            "modifiers": {
                                              "visibility": "Public"
                                            },
                                            "type_hint": null,
                                            "default": null,
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 55,
                                          "end": 64
                                        }
                                      },
                                      {
                                        "kind": {
                                          "Method": {
                                            "name": {
                                              "name": "f",
                                              "span": {
                                                "start": 75,
                                                "end": 76
                                              }
                                            },
                                            "by_ref": false,
                                            "params": [],
                                            "return_type": null,
                                            "body": [
                                              {
                                                "kind": {
                                                  "Return": {
                                                    "kind": {
                                                      "PropertyAccess": {
                                                        "object": {
                                                          "kind": {
                                                            "Variable": "this"
                                                          },
                                                          "span": {
                                                            "start": 88,
                                                            "end": 93
                                                          }
                                                        },
                                                        "property": {
                                                          "kind": {
                                                            "Identifier": "l"
                                                          },
                                                          "span": {
                                                            "start": 95,
                                                            "end": 96
                                                          }
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 88,
                                                      "end": 96
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 81,
                                                  "end": 97
                                                }
                                              }
                                            ],
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 66,
                                          "end": 99
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 43,
                                  "end": 101
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 101
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 102
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 104
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 106
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 106
  }
}

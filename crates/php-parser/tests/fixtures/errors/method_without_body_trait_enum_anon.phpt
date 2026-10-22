===source===
<?php
trait T { function f(); abstract function g(); }
enum E { function f(); }
$o = new class { function f(); };
===errors <=8.0===
Non-abstract method T::f() must contain body
'enums' requires PHP 8.1 or higher
Non-abstract method E::f() must contain body
Non-abstract method class@anonymous::f() must contain body
===errors >=8.1===
Non-abstract method T::f() must contain body
Non-abstract method E::f() must contain body
Non-abstract method class@anonymous::f() must contain body
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Non-abstract method T::f() must contain body in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 25,
                      "end": 26
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 29
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 48,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 60,
              "end": 61
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 73,
                      "end": 74
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 64,
                "end": 77
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 55,
        "end": 79
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
                  "start": 80,
                  "end": 82
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
                                "Method": {
                                  "name": {
                                    "name": "f",
                                    "span": {
                                      "start": 106,
                                      "end": 107
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [],
                                  "return_type": null,
                                  "body": null,
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 97,
                                "end": 110
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 85,
                        "end": 112
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 85,
                  "end": 112
                }
              }
            }
          },
          "span": {
            "start": 80,
            "end": 112
          }
        }
      },
      "span": {
        "start": 80,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}

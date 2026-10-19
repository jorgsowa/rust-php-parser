===source===
<?php
trait T { function f(); abstract function g(); }
enum E { function f(); }
$o = new class { function f(); };
===errors===
Non-abstract method T::f() must contain body
Non-abstract method E::f() must contain body
Non-abstract method class@anonymous::f() must contain body
===php_error===
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
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
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
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                                  "visibility": null,
                                  "is_static": false,
                                  "is_abstract": false,
                                  "is_final": false,
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

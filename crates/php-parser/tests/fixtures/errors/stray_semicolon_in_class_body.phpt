===source===
<?php
class A { ; }
interface I { function f(); ; }
trait T { public $x;; }
enum E { case A; ; }
$o = new class { function f() {}; };
===errors===
expected class member, found ';'
expected class member, found ';'
expected class member, found ';'
expected class member, found ';'
expected class member, found ';'
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected token ";", expecting "function" or "const" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token ";", expecting "function" in Standard input code on line 2
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
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 30,
              "end": 31
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 43,
                      "end": 44
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
                "start": 34,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 20,
        "end": 51
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 58,
              "end": 59
            }
          },
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 69,
                      "end": 71
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
                "start": 62,
                "end": 71
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 52,
        "end": 75
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 81,
              "end": 82
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 90,
                      "end": 91
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 85,
                "end": 92
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 76,
        "end": 96
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
                  "start": 97,
                  "end": 99
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
                                      "start": 123,
                                      "end": 124
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [],
                                  "return_type": null,
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 114,
                                "end": 129
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 102,
                        "end": 132
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 102,
                  "end": 132
                }
              }
            }
          },
          "span": {
            "start": 97,
            "end": 132
          }
        }
      },
      "span": {
        "start": 97,
        "end": 133
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}

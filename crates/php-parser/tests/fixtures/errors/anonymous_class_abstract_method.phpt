===source===
<?php
$o = new class {
    abstract function f();
    abstract protected static function g();
};
===errors===
Anonymous class method f() must not be abstract
Anonymous class method g() must not be abstract
===php_error <=8.4===
PHP Fatal error:  Class class@anonymous contains 2 abstract methods and must therefore be declared abstract or implement the remaining methods (class@anonymous::f, class@anonymous::g) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Anonymous class method f() must not be abstract in Standard input code on line 3
===ast===
{
  "stmts": [
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
                  "start": 6,
                  "end": 8
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
                                      "start": 45,
                                      "end": 46
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
                                "start": 27,
                                "end": 49
                              }
                            },
                            {
                              "kind": {
                                "Method": {
                                  "name": {
                                    "name": "g",
                                    "span": {
                                      "start": 89,
                                      "end": 90
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Protected",
                                    "is_static": true,
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
                                "start": 54,
                                "end": 93
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 95
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 95
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 95
          }
        }
      },
      "span": {
        "start": 6,
        "end": 96
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96
  }
}

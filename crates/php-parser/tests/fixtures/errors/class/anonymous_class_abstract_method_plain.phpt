===source===
<?php
$o = new class {
    abstract function f();
};
===errors===
Anonymous class method f() must not be abstract
===php_error <=8.4===
PHP Fatal error:  Class class@anonymous contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (class@anonymous::f) in Standard input code on line 2
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
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 51
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 51
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 51
          }
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}

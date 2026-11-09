===source===
<?php
$o = new class {
    abstract protected static function g();
};
===errors===
Anonymous class method g() must not be abstract
===php_error <=8.4===
PHP Fatal error:  Class class@anonymous contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (class@anonymous::g) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Anonymous class method g() must not be abstract in Standard input code on line 3
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
                                    "name": "g",
                                    "span": {
                                      "start": 62,
                                      "end": 63
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
                                "start": 27,
                                "end": 66
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 68
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 68
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 68
          }
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}

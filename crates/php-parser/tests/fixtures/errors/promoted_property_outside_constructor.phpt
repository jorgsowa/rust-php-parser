===description===
PHP rejects promoted property modifiers on non-constructor parameters with
"Cannot declare promoted property outside a constructor". The check fires
when any of visibility, set-visibility, final, or readonly appears on a
parameter outside __construct.
===source===
<?php
class A {
    public function notCtor(public int $x) {}
}
function f(public int $y) {}
$cb = function(public int $z) {};
===errors===
Cannot declare promoted property outside a constructor
Cannot declare promoted property outside a constructor
Cannot declare promoted property outside a constructor
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                  "name": "notCtor",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 51,
                              "end": 54
                            }
                          }
                        },
                        "span": {
                          "start": 51,
                          "end": 54
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 44,
                        "end": 57
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    },
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [
            {
              "name": "y",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 82,
                      "end": 85
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 85
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": "Public",
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 75,
                "end": 88
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 64,
        "end": 92
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "cb"
                },
                "span": {
                  "start": 93,
                  "end": 96
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": "z",
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 115,
                                "end": 118
                              }
                            }
                          },
                          "span": {
                            "start": 115,
                            "end": 118
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": "Public",
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 108,
                          "end": 121
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 99,
                  "end": 125
                }
              }
            }
          },
          "span": {
            "start": 93,
            "end": 125
          }
        }
      },
      "span": {
        "start": 93,
        "end": 126
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 126
  }
}
===php_error===
PHP Fatal error:  Cannot declare promoted property outside a constructor in Standard input code on line 3

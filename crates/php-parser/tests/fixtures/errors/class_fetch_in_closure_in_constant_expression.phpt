===source===
<?php
const A = static function () { echo (1 < 2)::class; };
===errors <=7.4===
Cannot use ::class with dynamic class name
'closures in constant expressions' requires PHP 8.5 or higher
===errors 8.0-8.2===
Cannot use "::class" on value of type bool
'closures in constant expressions' requires PHP 8.5 or higher
===errors 8.3-8.4===
Cannot use "::class" on true
'closures in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Cannot use "::class" on true
===php_error <=8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use "::class" on true in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Closure": {
                  "is_static": true,
                  "by_ref": false,
                  "params": [],
                  "use_vars": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Parenthesized": {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 43,
                                              "end": 44
                                            }
                                          },
                                          "op": "Less",
                                          "right": {
                                            "kind": {
                                              "Int": 2
                                            },
                                            "span": {
                                              "start": 47,
                                              "end": 48
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 43,
                                        "end": 48
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 42,
                                    "end": 49
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "class"
                                  },
                                  "span": {
                                    "start": 51,
                                    "end": 56
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 42,
                              "end": 56
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 37,
                        "end": 57
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 59
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 59
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}

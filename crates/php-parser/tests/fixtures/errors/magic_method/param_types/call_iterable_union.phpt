===source===
<?php
class B {
    function __call(string $n, iterable|Foo $a) {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
===errors 8.0-8.1===
B::__call(): Parameter #2 ($a) must be of type array when declared
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.1===
PHP Fatal error:  B::__call(): Parameter #2 ($a) must be of type array when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
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
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 29,
                      "end": 35
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 43,
                          "end": 45
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 36,
                              "end": 42
                            }
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 42
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 45
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 60,
                          "end": 62
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Union": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "iterable"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 47,
                                    "end": 55
                                  }
                                }
                              },
                              "span": {
                                "start": 47,
                                "end": 55
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Foo"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 56,
                                    "end": 59
                                  }
                                }
                              },
                              "span": {
                                "start": 56,
                                "end": 59
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 47,
                          "end": 59
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 47,
                        "end": 62
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
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
